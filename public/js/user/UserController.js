/**
 * Created by mac on 15/9/12.
 */

define(['ngmodule', 'user/UserView'], function(ngmodule, view, lang) {
    'use strict';

    var userCtrl = {
        infoController: function($scope, UserService) {

            view.init()
                .addService("changeNickname", function(newName) {
                    UserService.changeNickname({name: newName})
                        .then(function(response){
                            view.updateNickname(response.data);
                        },function(response){

                        });
                }
            );
        },

        changePasswordController: function($scope, UserService) {
            $scope.password = {
                email: '',
                new_password: '',
                new_password_confirmation: '',

                reset: function() {
                    this.email = "";
                    this.new_password = "";
                    this.new_password_confirmation = "";
                },

                changePassword: function() {

                    UserService.changePassword($scope.password).then(function(response) {
                        $scope.password.reset();
                        view.passwordChanged(response.data);
                    }, function(response) {
                        view.passwordChanged(response.data);
                    });
                }
            };
        },

        changeFaceController: function($scope, UserService) {

            $scope.face = {
                new_face: null,

                reset: function() {
                    this.new_face = null;
                },

                changeFace: function() {
                    var fd = new FormData();
                    fd.append('new_face', $scope.face.new_face);
                    UserService.changeFace(fd).then(function(response) {
                        view.updateFace(response.data);
                        $scope.face.reset();
                    }, function(response) {
                        view.alert(response.data);
                    });
                }
            };

            $scope.createFormData = function(file) {
                //var fd = new FormData();
                //fd.append('face', file);
                this.face.new_face = file;
            };
        }

    };

    ngmodule.controllers
        .controller("UserController", ['$scope', 'UserService', userCtrl.infoController])
        .controller("UserChangePasswordController", ['$scope', 'UserService', userCtrl.changePasswordController])
        .controller("UserChangeFaceController", ['$scope', 'UserService', userCtrl.changeFaceController]);

    return userCtrl;
});