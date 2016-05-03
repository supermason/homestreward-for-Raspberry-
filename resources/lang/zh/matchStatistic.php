<?php
/**
 * Created by PhpStorm.
 * User: SuperMason
 * Date: 2016/3/29
 * Time: 16:18
 */

return [
    'title' => '异常列表',
    'table' => [
        'header' => [
            'device' => '设备名称',
            'systemVersion' => '系统版本',
            'occurDate' => '发生时间',
        ],
        'tableRow' => [
            'empty' => '暂时没有任何异常信息',
            'show' => '详情',

        ],
        'pagination' => '每页显示@条，共#条异常信息',
    ],
    'newException' => [
        'title' => '数据测试',
        'device' => '设备型号',
        'system_version' => '系统版本',
        'exp_title' => '异常标题',
        'exception' => '异常信息'
    ]
];