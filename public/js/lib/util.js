/**
 * Created by mac on 15/10/31.
 */

/**
 * 定一个工具模块
 */
define([], function() {

    /*
     * 对字符串加入各种trim
     */
    (function() {

        String.prototype.trim = function () {
            return this.replace(/(^\s*)|(\s*$)/g, "");
        };

        String.prototype.ltrim = function () {
            return this.replace(/(^\s*)/g, "");
        };

        String.prototype.rtrim = function () {
            return this.replace(/(\s*$)/g, "");
        };

        /*
         * 对字符串加入startWith和endWith方法
         */
        String.prototype.startWith = function (str) {
            var reg = new RegExp("^" + str);
            return reg.test(this);
        };

        String.prototype.endWith = function (str) {
            var reg = new RegExp(str + "$");
            return reg.test(this);
        };

        /**
         * 字符串是否够长度
         *
         * @param len
         */
        String.prototype.isLongEnough = function(len) {
            return this.length >= len;
        }

    })();

    //==========================================
    // 创建工具对象
    //==========================================
    var util = {};

    /**
     * 判断是否为方法
     *
     * @param {function} fun 待判断的方法
     * @returns {boolean} 为方法－true｜否则－false
     */
    util.isFunction = function (fun) {
        if (fun && typeof(fun) === 'function') {
            return true;
        } else {
            return false;
        }
    };

    /**
     * 触发一个方法的调用
     *
     * @param {function} fun
     * @param params
     */
    util.invokeFunction = function (fun) {
        if (util.isFunction(fun)) {
            if (arguments.length > 1) {
                var args = [];
                for (var i = 1; i < arguments.length; ++i) {
                    args.push(arguments[i]);
                }
                fun.apply(null, args);
            } else {
                fun.call()
            }
        }
    }

    /**
     * 判断一个对象是否为数组
     *
     * @param {object} v
     * @returns {boolean}
     */
    util.isArray = function (v) {
        return toString.apply(v) === '[object Array]';
    };

    /**
     * 判断一个对象是否为字符串
     *
     * @param {object} v
     * @returns {boolean}
     */
    util.isString = function (v) {
        return toString.apply(v) === '[object String]';
    };

    /**
     * 判断一个对象里是否包含URL节点
     *
     * @param {object} obj
     * @returns {boolean}
     */
    util.hasURL = function(obj) {
        if (!obj) return false;
        if (this.isArray(obj)) return false;

        if (this.isString(obj) && obj !== '') {
            return true;
        } else {
            for (var k in obj) {
                if (k.toLocaleLowerCase() === 'url') {
                    if (this.isString(obj[k]) && obj[k] !== '') {
                        return true;
                    }
                }
            }
        }

        return false;
    };

    // 计时器
    var intervalId = 0;
    /**
     * 计时器对象
     * @type {{start: Function, stop: Function}}
     */
    util.timer = {
        /**
         * 开启计时器
         * @param {int} delay
         * @param {function} callback
         */
          start: function(callback, delay) {
              this.stop();

              if (util.isFunction(callback)) {
                  intervalId = setInterval(callback, delay);
              } else {
                  console.log('回调方法类型错误！');
              }

          },
        /**
         * 计时器结束
         */
          stop: function() {
            if (intervalId != 0) {
                clearInterval(intervalId);
            }
          }

    };

    /**
     * 过滤掉字符串中的各种非法字符
     *
     * @param {string} s
     * @returns {string}
     */
    util.stripScript = function (s) {
        var rs = "";

        if (s && s !== "") {
            var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]");

            for (var i = 0; i < s.length; i++) {
                rs = rs + s.substr(i, 1).replace(pattern, '');
            }
        }

        return rs;
    };

    /**
     * 拷贝对象(暂时只支持object)
     *
     * @param {object} src
     * @param {object} dest
     * @returns  {object}
     */
    util.copyObj = function(src, dest) {
        if (!src) return dest;

        if (!dest) dest = {};

        for (var key in src) {
            if (!(key in dest)) {
                dest[key] = src[key];
            }
        }

        return dest;
    };

    /**
     * 获取某年某月的天数
     *
     * @param {int} year
     * @param {int} month
     * @returns {number}
     */
    util.getMaxDayInGivenMonth = function(year, month) {
        if (month < 1)       month = 1;
        else if (month > 12) month = 12;

        var temp = new Date(year, month, 0);
        return temp.getDate();
    }

    return util;
});