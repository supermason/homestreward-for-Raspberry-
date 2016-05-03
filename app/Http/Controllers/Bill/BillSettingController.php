<?php

namespace App\Http\Controllers\Bill;

use App\ConsumptionCategory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Redirect, Input;

class BillSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json([
            'cc' => ConsumptionCategory::select(['id', 'name'])->orderBy("id")->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
//        try {
            if (ConsumptionCategory::create([
                'name' => Input::get('name'),
            ])) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
//        } catch (QueryException $exp) {
//            return response()->json(['success' => false, 'reason' => $exp]);
//        }
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
