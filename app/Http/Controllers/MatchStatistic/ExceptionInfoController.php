<?php

namespace App\Http\Controllers\MatchStatistic;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MatchStatisticExceptions;
use Illuminate\Support\Facades\Input;

class ExceptionInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("matchstatistic.index")->withData([
            'exceptions' => MatchStatisticExceptions::orderBy('created_at', 'desc')->paginate(16),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
//        return view("matchstatistic.create");
        return response("NotAllowed", 401);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //这里要判断是不是来自我们的app端
        $from = $request->headers->get("from");
        
        if (strcasecmp($from, "MC_NAB_APP") == 0) {
            // 验证一下必填项
            $this->validate($request, [
                'device' => 'required',
                'system_version' => 'required',
                'title' => 'required',
                'content' => 'required',
            ]);

            $exception = new MatchStatisticExceptions([
                'device' => Input::get('device'),
                'system_version' => Input::get('system_version'),
                'title' => Input::get('title'),
                'content' => Input::get('content'),
            ]);

            // 不用理会是否保存成功
            $exception->save();

            return response()->json(["statusCode" => 0, "message" => 'exceptionSaved']);
        } else {
            return response()->json(["statusCode" => -1, "message" => 'notAllowed']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 会自动抛出异常，在handler里单独处理一下
        $exception = MatchStatisticExceptions::findOrFail($id);

        //
        return view("matchstatistic.detail")->withData([
            "exception" => $exception,
        ]);
    }
}
