<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Util\Graphics\ImageUtil;

use Redirect, Input;

class UserController extends Controller
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $newName = Input::get('name');
        //
        $my = User::find(Auth::user()->id);
        $my->name = $newName;
        $my->save();

        return response()->json(['newName' => $newName]);
    }

    /**
     * 修改密码
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'new_password' => 'required|confirmed|min:6'
        ]);

        $user = User::findOrFail(Auth::user()->id);

        if ($user->email != Input::get('email')) {
            return response()->json(['success' => false, 'msgTag' => 'userNameWrong']);
        } else {
            $user->password = bcrypt(Input::get('new_password'));
            $user->save();

            return response()->json(['success' => true]);
        }
    }

    /**
     * 修改头像
     *
     * @param Request $request
     * @return string
     */
    public function changeFace(Request $request)
    {
        // 作为FormData上传的数据，用all来接受整个数据然后在通过key获取对应的value
        // 用Input::get(key)的方式是取不到数据的
        $data = Input::all();
        $img = $data['new_face'];

        $imgPath = ImageUtil::saveImg($img, 'img/wd/face/', 80, 80);

        if (!is_null($imgPath)) {
            $user = User::find(Auth::user()->id);
            $user->headImg = $imgPath;
            if ($user->save()) {
                return response()->json(['success' => true, 'facePath' => 'img/wd/face/' . $imgPath]);
            } else {
                return response()->json(['success' => false, 'msgTag' => 'faceSaveFailed']);
            }
        } else {
            return response()->json(['success' => false, 'msgTag' => 'uploadFailed']);
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
