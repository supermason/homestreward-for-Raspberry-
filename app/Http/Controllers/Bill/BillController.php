<?php

namespace App\Http\Controllers\bill;

use App\ConsumingRecords;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

use Redirect, Input;

class BillController extends Controller
{
    /**
     *  汇总图表时有月份数据 - 1
     */
    const BAR_DATA_WITH_MONTH = 1;
    /**
     * 汇总图表时没有月份数据 - 2
     */
    const BAR_DATA_WITHOUT_MONTH = 2;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $billInfo = [
            'amount' => Input::get('amount'),
            'category_id' => Input::get('categoryId'),
            'remark' => Input::get('remark'),
            'who' => Auth::user()->id,
        ];

        // 单独判断一下是否有填写消费时间
        $consumptionDate = Input::get("consumptionDate");
        if ($consumptionDate !== '') {
            // 注意格式 'H:i:s'＝24小时制，'h:i:s'＝12小时制
            $billInfo["consumption_date"] = $consumptionDate . " " . date('H:i:s', time());
        } else {
            $billInfo["consumption_date"] = date('y-m-d H:i:s', time());
        }

        if (ConsumingRecords::create($billInfo)) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }

//        return response()->json($billInfo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * 根据页码＋每页数量获取账单信息
     */
    public function search()
    {
        return $this->getQueryObj()
            ->whereRaw('date_format(consuming_records.consumption_date, "%Y%m") = date_format(curDate(), "%Y%m")')
            ->orderBy('consuming_records.consumption_date', 'desc')
            ->paginate(5)->toJson();

    }

    /**
     * 根据年月日查询账单纪录
     * @param int $year
     * @param int $month
     * @param int $day
     */
    public function searchByDate($year, $month, $day)
    {
        $targetDate = $year . '-' . $month . '-' . $day;

//        {
//            "total": 50,
//           "per_page": 15,
//           "current_page": 1,
//           "last_page": 4,
//           "next_page_url": "http://laravel.app?page=2",
//           "prev_page_url": null,
//           "from": 1,
//           "to": 15,
//           "data":[
//                {
//                    // Result Object
//                },
//                {
//                    // Result Object
//                }
//           ]
//        }

        // 按日期查询时，获取全部数据，所以不用给paginate传参
        return $this->getQueryObj()
            ->whereRaw('date_format(consuming_records.consumption_date, "%Y%m%d") = date_format("' . $targetDate . '", "%Y%m%d")')
            ->orderBy('consuming_records.created_at', 'desc')
            ->paginate()->toJson();
    }

    /**
     * 获取指定日期的消费总和
     *
     * @param string $year
     * @param string $month
     * @return response
     */
    public function total($year, $month=null)
    {
        $date = $this->validateDate($year, $month);

        $condition = '';
        if ($date['hasMonth']) {
            $condition = 'date_format(consuming_records.consumption_date, "%Y%m") = "' . $date['year'] . $date['month'] . '"';
        } else {
            $condition = 'date_format(consuming_records.consumption_date, "%Y") = "' . $date['year'] .'"';
        }

        return response()->json([
            'total' => ConsumingRecords::whereRaw($condition)->sum('amount'),
            'date' => $date['hasMonth'] ?
                            Lang::get('global.date.ym', ['year' => $date['year'], 'month' => $date['month']]) :
                            Lang::get('global.date.y', ['year' => $date['year']]),
        ]);

//        return response()->json(['r' => $date['year'] . $date['month']]);
    }

    /**
     * 获取指定日期内的图表数据
     *
     * @param string $year
     * @param null $month
     * @return response
     */
    public function chart($year, $month=null)
    {
        $date = $this->validateDate($year, $month);
        $byCC = intval(Input::get('byCC'));
        $condition = $date['hasMonth'] ? 'DATE_FORMAT(consuming_records.consumption_date, "%Y%m") = "' . $date['year'] . $date['month'] . '"' : 'DATE_FORMAT(consuming_records.consumption_date, "%Y") = "' . $date['year'] . '"';
        $queryObj = null;

        // 根据类型查询
        if ($byCC == 1) {
            // select是相同的,唯一不同的是日期条件
            $queryObj = ConsumingRecords::select(DB::raw('consumption_categories.name AS Category, SUM(consuming_records.amount) AS Amount'))
                ->leftJoin('consumption_categories', 'consuming_records.category_id', '=', 'consumption_categories.id')
                ->whereRaw($condition)
                ->groupBy('consuming_records.category_id');
        } else {
            $select = null;
            $groupBy = null;
            // 查询某年某月的日汇总
            if ($date['hasMonth']) {
                $select = DB::raw('DATE_FORMAT(consuming_records.consumption_date, "%e") AS Day, SUM(amount) AS Amount');
                $groupBy = 'Day';
                // 查询某年的月汇总
            } else {
                $select = DB::raw('DATE_FORMAT(consuming_records.consumption_date, "%c") AS Month, SUM(amount) AS Amount');
                $groupBy = 'Month';
            }

            $queryObj = ConsumingRecords::select($select)
                ->whereRaw($condition)
                ->groupBy($groupBy)
                ->orderBy('consuming_records.consumption_date');
        }

        return response()->json([
            'type' => $date['hasMonth'] ? BillController::BAR_DATA_WITH_MONTH : BillController::BAR_DATA_WITHOUT_MONTH,
            'title' => $date['hasMonth'] ?
                Lang::get('global.date.ym', ['year' => $date['year'], 'month' => $date['month']]) :
                Lang::get('global.date.y', ['year' => $date['year']]),
            'sum' => $queryObj->get(),
        ]);
    }

    /**
     * 日期检测
     *
     * @param string $year
     * @param null $month
     * @return array
     */
    private function validateDate($year, $month=null)
    {
        $hasMonth = !is_null($month);
        $temp = intval($year);

        // 做个判断，年份不能超过当前年
        $curYear = intval(date('Y'));
        if ($temp > $curYear) {
            $year = strval($curYear);
        }

        if ($hasMonth) {
            $temp = intval($month);
            if ($temp <= 0) {
                $month = null;
                $hasMonth = false;
            } else if ($temp > 12) {
                $month = '12';
            } else {
                if ($temp < 10) {
                    $month = '0' . $month;
                }
            }
        }

        return [
            'year' => $year,
            'month' => $month,
            'hasMonth' => $hasMonth
        ];
    }

    /**
     * 创建消费记录查询对象
     * @return mixed
     */
    private function getQueryObj()
    {
//        return ConsumingRecords::select('amount', 'cc.name AS category', 'remark', 'consuming_records.consumption_date AS date', 'u.name AS who')
//            ->join('consumption_categories AS cc', 'category_id', '=', 'cc.id')
//            ->leftJoin('users AS u', 'who', '=', 'u.id');

        return ConsumingRecords::select('amount', 'cc.name AS category', 'remark', DB::raw('DATE_FORMAT(consuming_records.consumption_date, "%Y-%m-%d") AS date'), 'u.name AS who')
            ->join('consumption_categories AS cc', 'category_id', '=', 'cc.id')
            ->leftJoin('users AS u', 'who', '=', 'u.id');
    }
}
