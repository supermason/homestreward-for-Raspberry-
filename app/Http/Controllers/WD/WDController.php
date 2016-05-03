<?php

namespace App\Http\Controllers\WD;

use Illuminate\Http\Request;

use App\Menu;
use App\Product;
use App\WdInfo;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return view("wd.index")->withData([
            'menu' => Menu::all(),
            'products' => $this->doSearchByCategory(WDConfig::PRODUCT_CATEGORY_JIEMIAN),
            'wdInfo' => WdInfo::find(1),
        ]);
    }

    /**
     * Display a listing of the latest resource.
     *
     * @param  int  $category
     * @return Response
     */
    public function latestIndex($category)
    {
        //
        return view("wd.index");
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
        return view("wd.detail");
    }

    /**
     * search products according to the given category
     *
     * @param int $category
     * @param string $keyword
     * @return Json Response
     */
    public function searchByCategory($category, $keyword=null)
    {
        return $this->doSearchByCategory($category, $keyword)->toJson();
    }

    /**
     * search products according to the given category
     *
     * @param $category
     * @param string $keyword
     * @return Response
     */
    private function doSearchByCategory($category, $keyword=null)
    {
        $queryObj = Product::where('category_id', '=', $category);

        if (!is_null($keyword)) {
            $queryObj = $queryObj->where('name', 'like', '%'.$keyword.'%');
        }

        return $queryObj
            ->orderBy('updated_at', 'desc')
            ->paginate(5);
    }
}
