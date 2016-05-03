<?php

namespace App\Http\Controllers\wd\admin;

use App\Util\Graphics\ImageUtil;
use App\WdInfo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WdInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
        return view('wd.admin.info.edit')->withData([
            'wdInfo' => WdInfo::find(1),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        // 先验证
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        //
        $wdInfo = WdInfo::findOrFail($id);

        $wdInfo->title = Input::get('title');
        $wdInfo->content = Input::get('content');

        // 单独处理图片
        $newLogo = ImageUtil::saveImgFromRequest($request, 'logo', 'img/wd/');
        if (!is_null($newLogo)) {
            $wdInfo->logo = $newLogo;
        }
        $newQr = ImageUtil::saveImgFromRequest($request, 'qrImg', 'img/wd/');
        if (!is_null($newQr)) {
            $wdInfo->qr_img = $newQr;
        }

        if ($wdInfo->save()) {
//            return redirect($request->getPathInfo(). '/edit')->withData([
//                'wdInfo' => $wdInfo,
//                'message' => [trans('adminTip.wdInfo.editInfo.success.edit')]
//            ]);
            return redirect($request->getPathInfo(). '/edit')->withInput()->withOk(trans('adminTip.wdInfo.editInfo.success.edit'));
        } else {
            return Redirect::back()->withInput()->withErrors('error');
        }
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
}
