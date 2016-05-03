<?php
/**
 * Created by PhpStorm.
 * User: mason.ding
 * Date: 2015/11/30
 * Time: 13:41
 */

namespace App\UI\Select;


/**
 * Class SelectCreator 创建select标签下的options，并根据当前选中值设置选中状态
 *
 * @package app\UI\Select
 */
class SelectCreator
{
    /**
     * 创建带有选中状态的select标签下的options html代码
     *
     * @param model $model 模型对象
     * @param array $columns 要读取的列明
     * @param int $selectedValue 希望选中的option对应的值
     * @return string
     */
    public static function createOptions($model, $columns, $selectedValue)
    {
        $html = "";

        if (is_array($columns) && count($columns) > 0) {

            $data = $model::all();

            foreach($data as $d) {
                $html .= ("<option value=\"" . $d[$columns[0]] . "\"" . static::setSelection($d[$columns[0]], $selectedValue) . ">" . $d[$columns[1]] . "</option>");
            }
        }

        return $html;
    }

    /**
     * 根据指定值判断一个option是否处于选中状态
     *
     * @param int $value
     * @param int $targetValue
     * @return string
     */
    private static function setSelection($value, $targetValue) {
        if ($value == $targetValue) {
            return " selected";
        } else {
            return "";
        }
    }
}