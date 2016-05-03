
/**
 * requirejs 专属配置文件
 */
requirejs.config({
    baseUrl: '/js/lib',
    paths: {
        lang: '../language',
        app: '../app',
        service: '../wd/wdService',
        template: '../wd/template'
    },
    deps: ['../wd/wdView'],
    urlArgs: "bust=" + (new Date()).getTime()  //防止读取缓存，调试用
});