/**
 * 初始化app
 */
require(['app', 'util'], function (app, util) {
    'use strict';

    require(['../services', '../controllers'], function () {
        // angular 应用
        var angularApp = angular.module(app.name, [app.name + ".controllers", app.name + ".services"])
            // 定一个directive用户文件上传
            .directive('fileModel', ['$parse', function($parse) {
                return {
                    restrict: 'A',
                    link: function(scope, element, attrs) {
                        var model = $parse(attrs.fileModel);
                        var modelSetter = model.assign;
                        element.bind('change', function(event) {
                            //scope.$apply(function() {
                            //    modelSetter(scope, element[0].files[0]);
                            //});

                            scope.createFormData(event.target.files[0]);
                        });
                    }
                };
            }]);
        // 配置一下$http拦截器，实现自动调用f7 ajax提示的功能
        angularApp.factory('wdInterceptor', ['$q', function($q) {
            return {
                'request': function(config) {
                    app.showPreloader();
                    return config;
                },

                'requestError': function(rejection) {
                    app.hidePreloader();
                    return $q.reject(rejection);
                },

                'response': function(response) {
                    app.hidePreloader();
                    return response;
                },

                'responseError': function(rejection) {
                    app.hidePreloader();
                    return $q.reject(rejection);
                }
            };
        }]);
        angularApp.config(['$httpProvider', function($httpProvider) {
            $httpProvider.interceptors.push('wdInterceptor');
            // angularjs 默认的ajax请求里是不带这个标识的，所以laravel端的$request->ajax()便无法正常工作（看源码就知道了）
            $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
        }]);
        // 手动初始化angular
        angular.bootstrap(document, [app.name]);
        // 保存一下对象
        app.angularApp = angularApp;
        // 最后初始化f7App
        app.init({
            hasInit:false,
            hasMainView: false
        });
    });
});