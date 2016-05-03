/**
 * Created by mac on 16/1/3.
 */
define(['ngmodule', 'app'], function(ngmodule, app) {

    'use strict';

    var baseApi = app.config.apiRoot + "inventory/",
        searchApi = baseApi + "search/",
        inApi = baseApi + "in",
        outApi = baseApi + "out",
        balancingApi = baseApi + "balancing";

    ngmodule.services.factory("InventoryService", ["$http", function($http) {

        return {
            search: function(keywords) {
                return $http.get(searchApi + keywords);
            },
            inventoryIn: function(product) {
                return $http({
                    method: "PUT",
                    url: inApi,
                    //dataType: 'json',
                    data: product
                });
            },
            inventoryOut: function(product) {
                return $http({
                    method: "PUT",
                    url: outApi,
                    //dataType: 'json',
                    data: product
                });
            },
            inventoryBalancing: function() {
                return $http.get(balancingApi);
            }
        };

    }]);

});