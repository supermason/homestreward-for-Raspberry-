/**
 * bill专属服务对象
 */
define(['ngmodule', 'app'], function (ngmodule, app) {
    'use strict';

    ngmodule.services
        .factory('BillService', ['$http', function ($http) {

            var baseAPI = app.config.apiRoot + 'bill/';

            return {
                get: function (args) {
                    //Arguments是一个类似数组但不是数组的对象，
                    //说它类似数组是因为其具有数组一样的访问性质及方式，
                    //可以由arguments[n]来访问对应的单个参数的值，
                    //并拥有数组长度属性length
                    var arg = arguments || [];
                    if (arg[1] === null || arg[1] === undefined || arg[1].length === 0) {
                        arg = [arg[0]];
                    }
                    switch (arg.length) {
                        case 1:
                            return $http.get(baseAPI + "search?page=" + arg[0]);
                        case 2:
                            return $http.get(baseAPI + "search/" + arg[1][0] + "/" + arg[1][1] + "/" + arg[1][2]);
                        default:
                            return $http.get(baseAPI);
                    }
                },
                getTotalExpense: function (year, month) {
                    return $http.get(baseAPI + 'total/' + year + (month ? "/" + month : ""));
                },
                getExpenseChartData: function (year, month, byCC) {
                    return $http.get(baseAPI + 'chart/' + year + (month ? "/" + month : "") + "?byCC=" + byCC);
                },
                add: function (bill) {
                    //return createRequest('POST', 'new', bill);

                    return $http({
                        method: 'POST',
                        url: baseAPI + 'new',
                        //dataType: 'json',
                        //headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        //headers: {'Content-Type': 'application/json'},
                        data: bill
                    });
                },
                destroy: function (id) {
                    return $http.delete(baseAPI + id);
                }
            };
    }])
        .factory("BillCTService", ['$http', function ($http) {

            var baseAPI = app.config.apiRoot + "bill/setting/";

            return {
                get: function () {
                    return $http.get(baseAPI + 'cc');
                },

                add: function (setting) {

                    return $http({
                        method: 'POST',
                        url: baseAPI + 'new',
                        //dataType: 'json',
                        data: setting
                    });
                }
            };
        }]);


});