/**
 * Created by mac on 15/12/26.
 */
define(['Chart.min', 'lang'], function(Chart, lang) {
    // canvas对象,用于画图
    var ctx = document.getElementById("canvas").getContext("2d"),
        // 柱状图数据对象
        myBarChartData = {
            barData: {
                labels: [],
                datasets: [
                    {
                        label: lang.bill.chart.toolTipTitle,
                        // The properties below allow an array to be specified to change the value of the item at the given index
                        // String  or array - the bar color
                        backgroundColor: "rgba(220,220,220,0.2)",
                        // String or array - bar stroke color
                        borderColor: "rgba(220,220,220,1)",
                        // Number or array - bar border width
                        borderWidth: 1,
                        // String or array - fill color when hovered
                        hoverBackgroundColor: "rgba(220,220,220,0.2)",
                        // String or array - border color when hovered
                        hoverBorderColor: "rgba(220,220,220,1)",
                        // The actual data
                        data: []
                    }
                ]
            },
            barOptions: {
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                },
                responsive: true
            },
            reset: function() {
                this.barData.labels.length = 0;
                this.barData.datasets.forEach(function(dataset, index) {
                    dataset.data.length = 0;
                });
            }
        },
        // 柱状图对象
        barChart = new Chart(ctx,{
            type: 'bar',
            data: myBarChartData.barData,
            options: myBarChartData.barOptions
        }),

        myBarChart = {
            /**
             * 更新图表数据并绘制
             *
             * @param data
             */
            update: function(data) {
                createChartData(data);
                barChart.clear();
                barChart.update();
            },
            /**
             * 重置数据
             */
            reset: function() {
                // 清理数据
                myBarChartData.reset();
            },
            type: {
                WITH_MONTH: 1,
                WITHOUT_MONTH: 2
            }
        };

    /**
     * 创建图表数据
     * @param data
     */
    function createChartData(data) {
        // 根据日期+消费类型汇总的
        if (data.byCC == 1) {
            createCCData(data);
            // 根据日期汇总的
        } else {
            var chartType = data.type;
            switch (chartType) {
                case myBarChart.type.WITH_MONTH:
                    // 带着月份的说明是X年X月内的日消费,返回1-月底的数量
                    createDayData(data);
                    break;
                case myBarChart.type.WITHOUT_MONTH:
                    // 不带月份的就是一年内12个月的汇总
                    createMonthData(data);
                    break;
                default:
                    break;
            }
        }
    }

    /**
     * 创建一年内每个月的消费图标数据
     *
     * @param data
     */
    function createMonthData(data) {
        // 复制一下,避免把模型数组也给删除了
        myBarChartData.barData.labels = lang.app.calendar.monthNames.concat();
        //
        for (var i = 0, j = 0; i < 12; ++i) {
            // 先判断是否有数据
            if (data.sum.length > 0 && j < data.sum.length && (i + 1 == data.sum[j]["Month"])) {
                myBarChartData.barData.datasets[0].data[i] = data.sum[j]["Amount"];
                j++;
            } else {
                myBarChartData.barData.datasets[0].data[i] = 0;
            }
        }
    }

    /**
     * 创建一个月内每日的消费图表数据
     *
     * @param data
     */
    function createDayData(data) {
        for (var i = 1; i <= data.maxDay; ++i) {
            myBarChartData.barData.labels[i-1] = i + "";
        }
        //
        for (var j = 0, k = 0; j < data.maxDay; ++j) {
            // 先判断是否有数据
            if (data.sum.length > 0 && k < data.sum.length && (j + 1 == data.sum[k]["Day"])) {
                myBarChartData.barData.datasets[0].data[j] = data.sum[k]["Amount"];
                k++;
            } else {
                myBarChartData.barData.datasets[0].data[j] = 0;
            }
        }
    }

    /**
     * 创建消费类型图表数据
     *
     * @param data
     */
    function createCCData(data) {
        for (var i = 0; i < data.sum.length; ++i) {
            myBarChartData.barData.labels[i] = data.sum[i].Category;
            myBarChartData.barData.datasets[0].data[i] = data.sum[i].Amount;
        }
    }

    return myBarChart;
});