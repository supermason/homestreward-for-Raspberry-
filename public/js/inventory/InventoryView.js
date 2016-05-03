/**
 * Created by mac on 16/1/3.
 */
define(['app', 'lang', 'util'], function(app, lang, util) {

    var f7App = app.f7App,
        $ = app.$$,
        service = {},
        pad = {
            view: null,
            render: null
        },
        inventoryView = {
            addService: function(key, func) {
                service[key] = func;
                return this;
            },
            init: function() {
                f7App.onPageInit("inventory-page", function(page) {
                    pad.view = f7App.autocomplete({
                        input: '#product-autocomplete-dropdown',
                        openIn: 'dropdown',
                        preloader: true, //enable preloader
                        valueProperty: 'id', //object's "value" property name
                        textProperty: 'name', //object's "text" property name
                        limit: 10, //limit to 20 results
                        dropdownPlaceholderText: '试着输入名称中的关键字即可',
                        expandInput: true, // expand input
                        source: function (autocomplete, query, render) {
                            var results = [];
                            if (query.trim().length === 0 || (query = util.stripScript(query)) === "") {
                                render(results);
                                // 如果关键字为空了，则重置选中的商品编号为空
                                updateFormData({id: ""});
                                return;
                            }
                            // Show Preloader
                            autocomplete.showPreloader();
                            // keep a reference to the render function
                            pad.render = render;
                            // Do Ajax request to Autocomplete data
                            service.searchPName(query);
                        },
                        onChange: function (a, clickedItem) {
                            updateFormData(clickedItem);
                        }
                    });
                });
            },
            renderACP: function(response) {
                pad.view.hidePreloader();
                pad.render(response.data.data);
            },
            ok: function (data) {
                this.alert(data, function() {
                    // 清除input中的数据
                    $('#product-autocomplete-dropdown').val("");
                });
            },
            alert: function(data, callback) {
                var type = data.type;
                if (data.success) {
                    app.alert(lang.inventory.success + "<br>" +  lang.inventory.count + data.count, callback);
                } else {
                    app.alert(lang.getErrByTag('inventory', type == 1 ? "in" : "out", data.msgTag));
                }
            },
            error: function(response) {
                app.handleError(response);
            }
        };

    /**
     * 根据autocomplete的选择,更新表单数据
     *
     * @param selectedItem
     */
    function updateFormData(selectedItem) {
        service.updatePID(selectedItem.id);
    }

    return inventoryView;

});