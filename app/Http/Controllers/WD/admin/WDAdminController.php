<?php

namespace App\Http\Controllers\wd\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * 仅仅是用来显示管理后台的首页
 *
 * Class WDAdminController
 * @package App\Http\Controllers\wd\admin
 */
class WDAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return view("wd.admin.index");
    }
}
