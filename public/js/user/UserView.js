
define(['app', 'lang'], function (app, lang) {
    'use strict';

    var f7App = app.f7App,
        $ = app.$$,
        service = {},
        userView = {
            addService: function(key, func) {
                service[key] = func;
                return this;
            },
            init: function() {

                f7App.onPageInit("personal-page", function(page) {
                    var pageCon = $(page.container);
                    pageCon.find("a.icon-only.prompt-title-ok-cancel").click(function() {
                        // 关闭可能打开的pickerModal
                        app.closePickerModal();
                        //
                        f7App.prompt(lang.user.changeNickname.info, lang.user.changeNickname.title,
                            function (value) {
                                if (value.trim() === '') {
                                    app.alert(lang.user.changeNickname.emptyError);
                                } else {
                                    service.changeNickname(value);
                                }
                            },
                            function (value) {

                            }
                        );
                    });
                    // 本页面点击右上角小人图标时，关闭可能的pickerModal
                    $("div[id='view-temp'] div.right > a").click(function() {
                        app.closePickerModal();
                    });

                });

                return this;
            },

            updateNickname: function(data) {
                $("span[id='user-info']").html(data.newName);
                $("p[id='userName']").text(data.newName);
            },

            passwordChanged: function(data) {
                // 必须先关闭界面，因为picker也属于modal的一种
                // 这个操作已经移动到app的showpreloader方法内
                //app.closePickerModal();
                if (data.success) {
                    this.alert(lang.user.changePassword.ok);
                } else {
                    this.alert(lang.getErrByTag('user', 'changePassword', data.msgTag), function() {
                        app.openPickerModal('.picker-modal.change-password-picker');
                    });
                }
            },

            updateFace: function(data) {
                if (data.success) {
                    $("div[id='view-temp'] .avatar-container .avatar>img").attr('src', data.facePath);
                    $("div.user-panel .avatar>img").attr('src', data.facePath);
                    this.alert(lang.user.changeFace.ok);
                } else {
                    this.alert(lang.getErrByTag('user', 'changeFace', data.msgTag), function() {
                        app.openPickerModal('.picker-modal.change-face-picker');
                    });
                }

            },

            alert: function(msg, callback) {
                app.alert(msg, callback);
            }
        };

    return userView;

});