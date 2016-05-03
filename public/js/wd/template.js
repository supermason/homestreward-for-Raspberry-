/**
 * 页面中使用的各种模板
 *
 * Created by mason.ding on 2015/11/4.
 */

define(['lang'], function(lang) {

    'use strict';

    var wdTemplate = {
        /**
         * 无查询结果模板
         */
        notFound: "<li class='not-found'>" + lang.product.notFound + "</li>",
        /**
         * 产品列表模板
         */
        productList:
            "{{#each data}}<li class=\"card wd-card-header-pic\">"
            + "<div data-background=\"/img/wd/product/{{category_id}}/{{thumbnail}}\" valign=\"bottom\" class=\"card-header color-white no-border lazy lazy-fadein\"><h2>{{name}}</h2></div>"
            + "<div class=\"card-content\">"
            +   "<div class=\"card-content-inner\">"
            +      "<p class=\"color-gray\">{{subtitle}}</p>"
            +      "<p>{{description}}</p>"
            +      "<p>" + lang.product.priceTitle + "<span class=\"normal-price\">300.00</span><span class=\"discount\">220.00</span></p>"
            +   "</div>"
            +   "</div>"
            +   "<div class=\"card-footer\">"
            +      "<a href=\"#\" class=\"link\"></a>"
            +      "<a href=\"#\" class=\"link\">" + lang.product.view + "</a>"
            +   "</div>"
          + "</li>{{/each}}"

    };

    return wdTemplate;
});
