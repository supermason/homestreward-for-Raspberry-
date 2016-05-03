
/**
 * angular模块对象，用于控制器、服务、指令等创建
 */
define(['app', 'angular.min'], function (app, angular) {
    'use strict';

    return {
        // 所有的控制器列表
        controllers: angular.module(app.name + ".controllers", []),
        // 所有的服务对象列表
        services: angular.module(app.name + ".services", [])
    }
});