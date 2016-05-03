<?php
/**
 * Created by PhpStorm.
 * User: mason.ding
 * Date: 2015/11/4
 * Time: 13:34
 */

namespace App\Util;


class WdUtil
{
    const PRODUCT_IMG_ROOT = '/img/wd/product/';

    /**
     * 获取产品图片的地址信息
     *
     * @param int $category
     * @param String $img
     * @return String 图片完整地址
     */
    static public function getProductImgUrl($category, $img)
    {
        return asset(WdUtil::PRODUCT_IMG_ROOT . $category . '/' . $img);
    }
}