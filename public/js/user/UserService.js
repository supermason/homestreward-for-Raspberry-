
define(["ngmodule", "app"], function (ngmodule, app) {
    'use strict';

    var baseApi = app.config.apiRoot + "user";

    ngmodule.services.factory("UserService", ["$http", function ($http) {

        var baseAPI = app.config.apiRoot + 'user/';

        /**
         * 常见一个请求对象
         *
         * @param {string} method 方法
         * @param {string} url
         * @param {object} data
         * @returns {*}
         */
        function createRequest(method, url, data) {
            return $http({
                method: method,
                url: baseAPI + url + "/",
                //dataType: 'json',
                //headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                data: data
            });
        }

        return {
            get: function () {
                return $http.get(baseApi);
            },
            changeNickname: function(user) {
                return createRequest('PUT', 'edit/name', user);
            },
            changePassword: function(password) {
                return createRequest('PUT', 'edit/password', password);
            },
            changeFace: function(face) {
                //return createRequest('PUT', 'edit/face', face);
                /*return $http({
                    method: 'PUT',
                    url: baseAPI + "edit/face",
                    data: face,
                    headers: {'Content-Type': undefined},
                    transformRequest: angular.identity
                });*/
                return $http.post(baseAPI + 'edit/face', face, {
                    withCredentials: true,
                    headers: {'Content-Type': undefined },
                    transformRequest: angular.identity
                });
            }
        };
    }]);
})