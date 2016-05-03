<?php
/**
 * Created by PhpStorm.
 * User: mason.ding
 * Date: 2015/11/16
 * Time: 15:09
 */

namespace App\UI\Navigation;


use Illuminate\Support\Facades\Request;

/**
 * Class NavigationCreator 负责创建导航条并让导航条状态跟随当前页面变化
 * @package app\UI\Navigation
 */
class NavigationCreator
{

    /**
     * 创建顶部导航内容，并根据当前页面做对应的高亮设置
     *
     * @return string
     */
    public static function createTopNavContent()
    {
        $curURL = Request::url();
        $nav = "<li><a href=\"". url('/wd/admin/products/') . "\"" . static::isCurLiEle($curURL, 'products') . ">" . trans('adminTip.nav.leftNav.product') . "</a></li>"
              . "<li><a href=\"" . url('/wd/admin/activities/') . "\"" . static::isCurLiEle($curURL, 'activities') . ">" . trans('adminTip.nav.leftNav.activities') . "</a></li>"
              . "<li><a href=\"" . url('/wd/admin/info/1/edit') . "\"" . static::isCurLiEle($curURL, 'info') . ">" . trans('adminTip.nav.leftNav.info') . "</a></li>"
              . "<li><a href=\"" . url('/matchstatistic/exception') . "\"" . static::isCurLiEle($curURL, 'matchstatistic') . ">" . trans('matchStatistic.title') . "</a></li>";

        return $nav;
    }

    public static function createSubNavContent()
    {

    }

    /**
     * 根据是否为当前页面设置高亮类
     *
     * @param string $url
     * @param string $liName
     * @return string
     */
    static private function isCurLiEle($url, $liName)
    {
        // strpos和stripos都是indexOf的功能，但是前者区分大小写
        if (stripos($url, $liName))
        {
            return " class=\"active\"";
        }
        else
        {
            return "";
        }
    }

}