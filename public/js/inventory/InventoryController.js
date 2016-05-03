/**
 * Created by mac on 16/1/3.
 */

define(['ngmodule', 'inventory/InventoryView'], function(ngmodule, view){

    'use strict';

    view.init();

    var inventoryCtrl = {

        inventoryInOutController: function($scope, InventoryService) {

            view.addService('searchPName', function(keywords) {
                if (keywords === "") return;

                InventoryService.search(keywords)
                    .then(function(response) {
                        view.renderACP(response);
                    }, function(response) {
                        view.error(response);
                    });
            }).addService('updatePID', function(selectedPID) {
                $scope.product.data.p_id = selectedPID;
            });

            $scope.product = {
                data: {
                    p_id: "",
                    p_count: "",
                    p_price: "",
                    disabled: function() {
                        return this.p_count == 0 || this.p_id == 0 || this.p_price == 0 || this.p_count === "" || this.p_id === "" || this.p_price === "";
                    },
                    reset: function() {
                        this.p_id = this.p_count = this.p_price = "";
                    }
                },
                purchase: function() {
                    InventoryService.inventoryIn($scope.product.data).then(
                        function(response) { // success
                            $scope.product.data.reset();
                            view.ok(response.data);
                        },
                        function(response) { // error
                            view.error(response);
                        }
                    );
                },
                sell: function() {
                    InventoryService.inventoryOut($scope.product.data).then(
                        function(response) {
                            $scope.product.data.reset();
                            view.ok(response.data);
                        },
                        function(response) {
                            view.error(response);
                        }
                    );
                }
            };
        },

        inventoryBalancingController: function($scope, InventoryService) {
            $scope.balancing = {
                inventory: 0,
                totalPrice: 0,
                totalPayment: 0,

                getBalancing: function() {
                    InventoryService.inventoryBalancing().then(
                        function(response) {
                            $scope.balancing.inventory = response.data.inventory;
                            $scope.balancing.totalPrice = response.data.totalPrice;
                            $scope.balancing.totalPayment = response.data.totalPayment;
                        },
                        function(response) {

                        }
                    );
                }
            };
        }
    };

    ngmodule.controllers
        .controller("inventoryInOutController", ['$scope', 'InventoryService', inventoryCtrl.inventoryInOutController])
        .controller("inventoryBalancingController", ['$scope', 'InventoryService', inventoryCtrl.inventoryBalancingController]);

    return inventoryCtrl;
});