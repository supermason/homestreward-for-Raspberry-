<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class SeederHelper {
    
    /**
     * Seed辅助工具，填充各模型对应的数据库表
     *
     * @param  Illuminate\Database\Eloquent\Model  $model
     * @param array $dataList 需要填充的数据列表
     * @return void
     */
    public static function doSeed($model, $dataList)
    {
        $count = count($dataList);
        
        for ($i = 0; $i < $count; ++$i)
        {
            $model::create([
                'name' => $dataList[$i]
            ]);
        }
    }
}
