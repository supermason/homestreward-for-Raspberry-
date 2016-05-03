
/**
 * requirejs 专属配置文件
 */
requirejs.config({
    baseUrl: 'js/lib',

    paths: {
        lang: '../language',
        bill: '../bill',
        user: '../user',
        inventory: '../inventory',
        app: '../app',
        ngmodule: '../ngmodule',
        bootstrap: '../bootstrap'
    },

    shim: {
        'angular.min': {
            exports: 'angular'
        },
        'Chart.min': {
            exports: 'Chart'
        }
        //'angular-resource': {
        //    deps: ['angular'],
        //    exports: 'angular-resource'
        //}
    },
    deps: ['bootstrap'], //要先加载bootstrap.js文件
    urlArgs: "bust=" + (new Date()).getTime()  //防止读取缓存，调试用
});