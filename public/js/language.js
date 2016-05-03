/**
 * 语言定义文件
 *
 * Created by mason.ding on 2015/11/5.
 */

define([], function(){

    var lang = {
        /**
         * app定义相关文字
         */
        app: {
            modalTitle: "提示",
            modalButtonOk: '确定',
            modalButtonCancel: '取消',
            preloaderTip: "努力加载中...",
            calendar: {
                monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                dayNames: ['星期天', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
                dayNamesShort: ['星期天', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六']
            },
            dateTimePickerTip: '不选则按当前时间查询',
            close: "关闭"
        },
        /**
         * 记帐相关文字
         */
        bill: {
            addRecords: {
                ok: '记录添加成功！',
                fail: '记录添加失败！'
            },
            chart: {
                title: '消费汇总表',
                toolTipTitle: '消费总数'
            },
            closeAndRemoveDate: '关闭并清除日期'
        },
        /**
         * 产品相关文字
         */
        product: {
            priceTitle: "售价：",
            view: "查看宝贝",
            notFound: "抱歉，暂时没有您要找的宝贝T_T，请看点别的吧~",
            hasNoMore: "没有更多宝贝了"
        },
        /**
         * 库存管理相关文字
         */
        inventory: {
            success: "数据保存成功!",
            count: "该商品当前库存：",
            in: {
                inventoryInFailed: "进货数据保存失败!"
            },
            out: {
                inventoryNotEnough: "库存数量不足，请先进货！",
                inventoryOutFailed: "出货数据保存失败!"
            }
        },
        /**
         * 用户相关文字
         */
        user: {
            changeNickname: {
                title: '修改昵称',
                info: '你想叫什么好呢？',
                emptyError: '请输入新的昵称'
            },
            changePassword: {
                userNameWrong: '输入的用户名错误！',
                notLongEnough: '密码长度需要最少6位',
                notConfirmed: '两次输入的密码不一致',
                ok: '密码修改成功！'
            },
            changeFace: {
                ok: '头像修改成功！',
                faceSaveFailed: '头像保存失败！',
                uploadFailed: '头像上传失败！'
            }
        },

        /**
         * 根据所属分组获取错误提示
         *
         * @param group
         * @param subGroup
         * @param tag
         * @returns {*}
         */
        getErrByTag: function(group, subGroup, tag) {
            var msg = this[group][subGroup][tag];

            if (!msg) {
                msg = '未知错误！';
            }

            return msg;
        }
    };

    return lang;
});