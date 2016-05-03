<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 15/12/19
 * Time: 下午5:49
 */

namespace app\UI;


class UITool
{

    /**
     * 是否有足够的数量
     *
     * @param int $count
     * @param int $reference
     * @return string
     */
    public static function hasEnough($count, $reference = 0)
    {
        $returnStr = 'class=zero';

        if ($count > $reference) {
            $returnStr = 'class=has-inventory';
        }

        return $returnStr;
    }
}