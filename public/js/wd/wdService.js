/**
 * Created by mac on 15/11/1.
 */

define(['app', 'util'], function(app, util) {

    'use strict';

    // 该模块的api地址
    var wdApiRoot = createSubServiceApiRoot();
    // 该模块的服务对象
    var service = {
        apiRoot: wdApiRoot
    };

    /**
     * 调用api接口获取数据
     * @param param {Object} 传入的参数，必须包含[url|onSuccess]
     */
    service.call = function(param) {

        if (!util.hasURL(param)) return;

        app.$$.ajax({
            method: param.method ? param.method : "GET",
            url: wdApiRoot + param.url,
            beforeSend: function (xhr) {

                app.showPreloader();

                if (util.isFunction(param.beforeSend)) {
                    param.beforeSend.call(null, xhr);
                }
            },
            error: function (xhr, status) {
                if (util.isFunction(param.onError)) {
                    param.onError.call(null, xhr, status);
                }
            },
            success: function (data, status, xhr) {
                if (util.isFunction(param.onSuccess)) {
                    param.onSuccess.call(null, data);
                }
            },
            complete: function(xhr, status) {
                app.hidePreloader();
            }
        });
    };

    function createSubServiceApiRoot() {
        return app.config.apiRoot + "wd/";
    }

    return service;
});