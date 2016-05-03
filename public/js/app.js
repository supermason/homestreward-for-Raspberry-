/**
 * 创建myApp 对象
 * myApp包含：f7-Framework7的对象
 *           $$-Framework7的选择器变体
 *           mv-Framework7的主视图
 */
define(['framework7.min', 'util', 'lang'], function (fw7, util, lang) {
    'use strict';

    var myApp = {
            name: "myApp", // 名称
            config: { // 配置
                apiRoot: 'http://www.homestreward.cn/'
            }
        },

        f7App = new Framework7({ // f7应用，默认不初始化
            init: false,
            modalTitle: lang.app.modalTitle,
            modalButtonOk: lang.app.modalButtonOk,
            modalButtonCancel: lang.app.modalButtonCancel,
            smartSelectBackOnSelect: true,
            cache: false,
            pushState: true,
            preloadPreviousPage: false
            //swipePanel: 'left'
        }),

        $$ = Framework7.$;
    // 变体
    myApp.$$ = $$;
    // 显示preloader
    myApp.showPreloader = function() {
        // 在显示提示前，不管有什么modal，都一并关闭了
        f7App.closeModal();
        f7App.showPreloader(lang.app.preloaderTip);
    };
    // 隐藏preloader
    myApp.hidePreloader = function() {
        f7App.hidePreloader();
    }
    // alert
    myApp.alert = function (msg, callback) {
        f7App.alert(msg, callback);
    };
    // 赋值
    myApp.f7App = f7App;
    // toString
    myApp.toString = function () {
        return "app-version: 1.0.0.0"
                + "\nframework7-version: " + f7App.version
    };

    // 其他公有方法
    /**
     * 初始化应用
     * @param option {Object} - 根据不同的应用，做对应的初始化
     */
    myApp.init = function(options) {
        myApp.$$.ajaxSetup({"dataType": "json"});
        if (options) {
            if (!options.hasInit) {
                f7App.init();
            }
            // 主视图：对于tab类型的应用，没有view-main 这个class
            if (options.hasMainView) {
                f7App.addView('.view-main', {
                    dynamicNavbar: true
                });
            }
        }
    };

    /**
     * 结束下拉刷新
     *
     */
    myApp.pullToRefreshDone = function() {
        f7App.pullToRefreshDone();
    }

    /**
     * 设置一个组件显示或者隐藏
     *
     * @param {string} selector
     * @param {boolean} show
     */
    myApp.setElementShowOrHide = function (selector, show) {
        var element = $$(selector);
        if (element.length > 0) {
            if (show) {
                if (element.hasClass('hidden')) {
                    element.removeClass('hidden');
                }
            } else {
                if (!element.hasClass('hidden')) {
                    element.addClass('hidden');
                }
            }
        }
    }

    /**
     * 更新一组列表的高亮状态
     *
     * @param {string} selector
     * @param {dom-element} selected
     * @param {string} className
     */
    myApp.updateHighlight = function(selector, selected, className) {
        if (selected && selected.length > 0) {
            var eleName = selected[0].localName;
            $$(selector).find(eleName).removeClass(className);
            selected.addClass(className);
        }

    }

    /**
     * 创建日历
     *
     * @param {object} options
     *               必须包含：{string} input
     *                        {function} onDayClick
     *               可选参数：{boolean} inputReadOnly 默认为false
     *                        {boolean} closeOnSelect 默认为true
     *                        {function} onClose
     * @return {object}
     */
    myApp.createCalendar = function(options) {
        if (!options) return null;
        if (!options['input']) return null;
        if (options['input'] === '') return null;
        if (!util.isFunction(options['onDayClick'])) return null;

        var params = util.copyObj({
            closeOnSelect: true,
            monthNames: lang.app.calendar.monthNames,
            dayNames: lang.app.calendar.dayNames,
            dayNamesShort: lang.app.calendar.dayNamesShort,
            onClose: null,
        }, options);

        var myCalendar = f7App.calendar(params);

        return myCalendar;
    }


    /**
     * 创建一个日期选择器
     *
     * @param {object} options
     *                 必须包含: {string} input
     * @returns {picker}
     */
    myApp.createDateTimePicker = function(options) {
        if (!options) return null;
        if (!options['input']) return null;
        if (options['input'] === '') return null;

        var params = util.copyObj({
            rotateEffect: true,
            toolbarTemplate:
                '<div class="toolbar">' +
                    '<div class="toolbar-inner">' +
                        '<div class="left">' +
                            '<p style="font-size: 10px;">' + lang.app.dateTimePickerTip + '</p>' +
                        '</div>' +
                        '<div class="right">' +
                            '<a href="#" class="link close-picker">' + lang.app.modalButtonOk + '</a>' +
                        '</div>' +
                    '</div>' +
                '</div>',
            cols: [{
                    values: (function() {
                        var yearArray = [],
                            curYear = new Date().getFullYear();

                        for (var i = 0; i < 10; ++i) {
                            yearArray[i] = curYear - i;
                        }

                        return yearArray;
                    })()
                }, {
                    values: ('0 1 2 3 4 5 6 7 8 9 10 11 12').split(' '),
                    displayValues: ['----'].concat(lang.app.calendar.monthNames)
                }
            ],
            onChange: function(picker, values, displayValues) {

            },
            formatValue: function(p, values, displayValues) {
                return values[0] + (values[1] === '0' ? "" : "-" + values[1]);
            }
        }, options);

        var dateTimePicker = f7App.picker(params);

        return dateTimePicker;
    }

    /**
     * 打开pickerModal
     *
     * @param {string} selector
     */
    myApp.openPickerModal = function(selector) {
        f7App.pickerModal(selector);
    },

    /**
     * 关闭pickerModal
     *
     */
    myApp.closePickerModal = function() {
        f7App.closeModal('.picker-modal.modal-in');
    }

    /**
     * 关闭手风琴布局／可折叠布局
     *
     * @param {string} element 想要操作的条目的CSS选择器
     */
    myApp.closeAccordion = function(element) {
        f7App.accordionClose(element);
    },

    /**
     *  打开一个popup
     *
     *  @param {string} 选择器
     *
     */
    myApp.openPopUp = function(selector) {
        f7App.popup(selector);
    }

    /**
     * 统一简单的错误处理
     *
     * @param {Object} error
     */
    myApp.handleError = function(error) {
        var msg = "";

        if (error.exception) {
            msg = error.msg;
        } else {
            if (error.data) {
                for (var key in error.data) {
                    msg += "[" + key + "] = " + error.data[key][0]
                }
            } else {
                msg = "status: " + error.status + ", statusText: " + error.statusText;
            }
        }

        f7App.alert(msg);
    }

    return myApp;
});



    

