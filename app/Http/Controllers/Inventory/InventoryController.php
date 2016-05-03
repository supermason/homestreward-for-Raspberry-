<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use App\Product;
use App\InventoryLog;

class InventoryController extends Controller
{
    /**
     * 根据关键字搜索商品
     *
     * @param $keywords
     * @return response
     */
    public function search($keywords)
    {
        return Product::select('id', 'name')->where('name', 'like', '%' . $keywords . '%')->orderBy('created_at', 'desc')->paginate(10)->toJson();
    }

    /**
     * 进货
     *
     * @param Request $request
     * @return response
     */
    public function inventoryIn(Request $request)
    {
        // 先验证
        $this->validate($request, [
            'p_id' => 'required',
            'p_count' => 'required|numeric',
            'p_price' => 'required|numeric',
        ]);

        $id = Input::get("p_id");
        $count = intval(Input::get("p_count"));
        $product = Product::findOrFail($id);
        $product->count += $count;

        if ($product->save()) {
            // 货品更新成功了,记录一下log
            $log = new InventoryLog([
                'product_id' => $id,
                'count' => $count,
                'price' => Input::get("p_price"),
                'type' => InventoryConfig::IN,

            ]);

            $log->save();

            return response()->json(['success' => true, 'count' => $product->count]);

        } else {
            return response()->json(['success' => false, 'msgTag' => "inventoryInFailed", 'type' => 1]);
        }
    }

    /**
     * 出货
     *
     * @param Request $request
     * @return response
     */
    public function inventoryOut(Request $request)
    {
        // 先验证
        $this->validate($request, [
            'p_id' => 'required',
            'p_count' => 'required|numeric',
            'p_price' => 'required|numeric',
        ]);

        $id = Input::get("p_id");
        $count = intval(Input::get("p_count"));

        $product = Product::findOrFail($id);
        // 这里要怎么处理呢? 预售的话,是没有库存数量的
        if ($product->count < $count) {
            return response()->json(['success' => false, 'msgTag' => 'inventoryNotEnough']);
        } else {
            $product->count -= $count;
        }

        if ($product->save()) {
            // 货品更新成功了,记录一下log
            $log = new InventoryLog([
                'product_id' => $id,
                'count' => $count,
                'price' => Input::get("p_price"),
                'type' => InventoryConfig::OUT,

            ]);

            $log->save();

            return response()->json(['success' => true, 'count' => $product->count]);

        } else {
            return response()->json(['success' => false, 'msgTag' => "inventoryOutFailed", 'type' => 2]);
        }
    }

    /**
     * 库存结算
     *
     * @return response
     */
    public function balancing()
    {
        return response()->json([
            'inventory' => Product::sum('count'),
            'totalPrice' => InventoryLog::where('type', '=', InventoryConfig::IN)->sum(DB::raw('count * price')),
            'totalPayment' => InventoryLog::where('type', '=', InventoryConfig::OUT)->sum(DB::raw('count * price')),
        ]);
    }
}
