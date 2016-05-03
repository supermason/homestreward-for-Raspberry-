<!DOCTYPE html>
<html>
  <head>
    <!-- Required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- Your app title -->
    <title>JM的小管家</title>
    <!-- Path to Framework7 Library CSS, iOS Theme -->
    <link rel="stylesheet" href="/css/framework7.ios.min.css">
    <!-- Path to Framework7 color related styles, iOS Theme -->
    <link rel="stylesheet" href="/css/framework7.ios.colors.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- Path to your custom app styles-->
    <link rel="stylesheet" href="/css/app.css" />
  </head>
  <body>
    <!-- Status bar overlay for full screen mode (PhoneGap) -->
    <div class="statusbar-overlay"></div>
    <div class="panel-overlay"></div>
    <div class="panel panel-left-add panel-left panel-reveal">
      <div class="content-block-title"><p>添加消费记录</p></div>
      <form method="post" id="addForm" name="addForm" ng-controller="AddController" ng-submit="newData.addBill()">
        <div class="list-block">
          <ul>
              <li class="accordion-item">
                  <a href="#" class="item-link item-content">
                      <div class="item-inner">
                          <p>消费类型</p>
                      </div>
                  </a>
                  <div class="accordion-item-content">
                      <div class="list-block">
                          <ul>
                              <li ng-repeat="category in newData.categories" ng-click="newData.bill.updateData(this)">
                                  <label class="label-radio item-content">
                                      <input type="radio" name="categoryId" value="{{category.id}}" ng-model="newData.bill.categoryId">
                                      <div class="item-inner">
                                          <small>{{category.name}}</small>
                                      </div>
                                  </label>
                              </li>
                          </ul>
                      </div>
                  </div>
              </li>
            <li>
              <div class="item-content">
                <div class="item-inner">
                  <div class="item-input">
                    <input type="text" name="amount" placeholder="今天花了多少票票" required ng-pattern="/^\d+(\.\d+)?$/" title="请输入数字" ng-model="newData.bill.amount">
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="item-content">
                <div class="item-inner">
                  <div class="item-input">
                    <input type="text" name="remark" ng-model="newData.bill.remark" placeholder="有什么想补充的，写在这里吧">
                  </div>
                </div>
              </div>
            </li>
            <li>
                <div class="item-content">
                    <div class="item-inner">
                        <div class="item-input">
                            <input type="text" id="calendar-consumption" name="consumptionDate" ng-model="newData.bill.consumptionDate" placeholder="消费日期，不填则为当前时间">
                        </div>
                    </div>
                </div>
            </li>
            <li>
              <div class="item-content">
                <div class="item-inner">
                  <input type="submit" class="button right" value="添加" ng-disabled="newData.bill.amount==undefined||newData.bill.amount==''||newData.bill.categoryId==0" />
                </div>
              </div>
            </li>
          </ul>
        </div>
      </form>
      <div class="content-block">
          <p><a href="#" id="addNewCT" class="button button-fill prompt-title-ok-cancel">新增消费类型</a></p>
      </div>
      <div class="list-block inset">
          <ul>
              <li>
                  <div class="item-content">
                      <div class="item-inner">
                          <p class="bill-total-title">查询消费总和或报表</p>
                      </div>
                  </div>
              </li>
              <li>
                  <div class="item-content">
                      <div class="item-inner">
                          <div class="item-input">
                              <input type="text" placeholder="请选择要计算的日期，不选择为当月数据" name="dateTime" id="dateTime-picker">
                          </div>
                      </div>
                  </div>
              </li>
              <li>
                  <label class="label-checkbox item-content">
                      <!-- Checked by default -->
                      <input type="checkbox" name="byCC" value="0" >
                      <div class="item-media">
                          <i class="icon icon-form-checkbox"></i>
                      </div>
                      <div class="item-inner">
                          <div class="item-title"><span class="by-cc">根据消费类型</span></div>
                      </div>
                  </label>
              </li>
              <li>
                  <div class="item-content">
                      <div class="item-inner">
                          <div class="item-input">
                              <a href="#" id="calTotal" class="button">查询总和</a>
                          </div>
                      </div>
                  </div>
              </li>
              <li>
                  <div class="item-content">
                      <div class="item-inner">
                          <div class="item-input">
                              <a href="#" id="getChartData" class="button">查看报表</a>
                          </div>
                      </div>
                  </div>
              </li>
          </ul>
      </div>
    </div>
    <div class="panel panel-right panel-reveal user-panel">
      <div class="content-block">
        <div class="content-block-inner">
            <div class="avatar">
                <img src="<?php echo '/img/wd/face/' . Auth::user()->headImg ?>">
            </div>
            <p id="userName"><?php echo Auth::User()->name ?></p>
        </div>
      </div>
        <div class="list-block">
            <ul>
                <li>
                    <a class="item-link list-button external" href="<?php echo url('/wd')?>"><strong>微店</strong>逛逛</a>
                </li>
                <li>
                    <a class="item-link list-button external" href="<?php echo url('/wd/admin') ?>"><strong>宝贝</strong>管理</a>
                </li>
                <li>
                    <a class="item-link list-button external" href="<?php echo url('/matchstatistic/exception') ?>"><strong>查看</strong>异常</a>
                </li>
                <li>
                    <a class="item-link list-button external" href="<?php echo url('/auth/logout') ?>"><strong>退出</strong>系统</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- Views -->
    <div class="views tabs toolbar-through theme-m">
        <!-- Your main view, should have "view-main" class -->
        <div class="view tab active" id="view-bill">
            <!-- Top Navbar-->
            <div class="navbar">
              <div class="navbar-inner">
                <div class="left sliding">
                  <a href="#" data-panel="left" class="link icon-only open-panel">
                    <i class="icon icon-plus"><strong>+</strong></i>
                  </a>
                </div>
                <!-- We need cool sliding animation on title element, so we have additional "sliding" class -->
                <div class="center">记帐吧</div>
                  <div class="right">
                      <a href="#" data-panel="right" class="link icon-only open-panel">
                          <i class="fa fa-user"></i>
                      </a>
                  </div>
              </div>
            </div>
            <!-- Pages container, because we use fixed-through navbar and toolbar, it has additional appropriate classes-->
            <div class="pages navbar-through">
              <!-- Page, "data-page" contains page name -->
              <div data-page="bill-page" class="page">
                <!-- Search bar with "searchbar-init" class for auto initialization -->
                <form class="searchbar">
                  <div class="searchbar-input">
                    <input type="search" placeholder="请输入日期" id="calendar-default" >
                    <a href="#" class="searchbar-clear"></a>
                  </div>
                  <a href="#" class="searchbar-cancel">取消</a>
                </form>

                <!-- Search bar overlay -->
                <div class="searchbar-overlay"></div>
                <!-- Scrollable page content -->
                <div class="page-content pull-to-refresh-content infinite-scroll" data-ptr-distance="30" data-distance="50" ng-controller="SearchController" >
                  <div class="pull-to-refresh-layer">
                    <div class="preloader"></div>
                    <div class="pull-to-refresh-arrow"></div>
                  </div>
                  <div class="content-block-title">消费记录</div>
                  <div class="list-block media-list searchbar-found hidden">
                    <div class="card" ng-repeat="bill in data.bills">
                      <div class="card-content">
                        <div class="card-header">
                            {{$index+1}}、{{bill.who}} <span class="date">{{bill.date}}</span>
                        </div>
                        <div class="card-content">
                          <div class="card-content-inner">{{bill.category}}: {{bill.amount}}</div>
                        </div>
                        <div class="card-footer" ng-if="bill.remark !== null && bill.remark !==''">
                          备注：{{bill.remark}}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="list-block-label">
                    <p style="text-align:center;">载入中...</p>
                  </div>
                  <!-- 加载提示符 -->
                  <div class="infinite-scroll-preloader center">
                    <div class="preloader"></div>
                  </div>
                </div>
              </div>
          </div>
        </div>
        <!-- Second view -->
        <div class="view tab" id="view-ws">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="left sliding">

                    </div>
                    <!-- We need cool sliding animation on title element, so we have additional "sliding" class -->
                    <div class="center">库存管理</div>
                    <div class="right">
                        <a href="#" data-panel="right" class="link icon-only open-panel">
                            <i class="fa fa-user"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="pages navbar-through">
                <div class="page" data-page="inventory-page">
                    <div class="page-content">
                        <div class="content-block">
                            <!-- tabs控制面板 -->
                            <div class="buttons-row">
                                <a href="#tab-in-out" class="tab-link active button">进出货</a>
                                <a href="#tab-query" class="tab-link button">查询</a>
                            </div>
                        </div>
                        <div class="tabs-animated-wrap">
                            <!-- Tabs -->
                            <div class="tabs">
                                <!-- Tab 1，默认激活 -->
                                <div id="tab-in-out" class="tab active" ng-controller="inventoryInOutController">
                                    <div class="list-block accordion-list inset">
                                        <ul>
                                            <li class="item-content list-search-bar">
                                                <div class="item-inner">
                                                    <div class="item-title label">宝贝名称</div>
                                                    <div class="item-input">
                                                        <input type="text" placeholder="请输入宝贝名称进行搜索" id="product-autocomplete-dropdown"/>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="accordion-item">
                                                <a href="#" class="item-link item-content">
                                                    <div class="item-inner">
                                                        <div class="item-title">我要进货</div>
                                                    </div>
                                                </a>
                                                <div class="accordion-item-content">
                                                    <form id="inventory-in-form" name="inventory-in-form" ng-submit="product.purchase()">
                                                        <div class="list-block">
                                                            <ul>
                                                                <li>
                                                                    <div class="item-content">
                                                                        <div class="item-inner">
                                                                            <div class="item-input">
                                                                                <input type="number" placeholder="请输入本次进货数量" ng-model="product.data.p_count" required ng-pattern="/^[0-9]*$/"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="item-content">
                                                                        <div class="item-inner">
                                                                            <div class="item-input">
                                                                                <input type="number" placeholder="请输入本次货品价格" ng-model="product.data.p_price" required ng-pattern="/^\d+(\.\d+)?$/"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="item-content">
                                                                        <div class="item-inner">
                                                                            <div class="item-input">
                                                                                <input type="submit" class="button" value="进货" ng-disabled="product.data.disabled()"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </form>
                                                    <div class="go-to-wd">
                                                        <p>如果是新进货品,请点击<a href="<?php echo url('/wd/admin/products/create') ?>" class="external">这里</a>进行添加</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="accordion-item">
                                                <a href="#" class="item-link item-content">
                                                    <div class="item-inner">
                                                        <div class="item-title">我要出货</div>
                                                    </div>
                                                </a>
                                                <div class="accordion-item-content">
                                                    <form id="inventory-out-form" name="inventory-out-form" ng-submit="product.sell()">
                                                        <div class="list-block">
                                                            <ul>
                                                                <li>
                                                                    <div class="item-content">
                                                                        <div class="item-inner">
                                                                            <div class="item-input">
                                                                                <input type="number" placeholder="请输入本次出货数量" ng-model="product.data.p_count" required ng-pattern="/^[0-9]*$/"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="item-content">
                                                                        <div class="item-inner">
                                                                            <div class="item-input">
                                                                                <input type="number" placeholder="请输入本次出售价格" ng-model="product.data.p_price" required ng-pattern="/^\d+(\.\d+)?$/"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="item-content">
                                                                        <div class="item-inner">
                                                                            <div class="item-input">
                                                                                <input type="submit" class="button" value="出货" ng-disabled="product.data.disabled()"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </form>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Tab 2 -->
                                <div id="tab-query" class="tab" ng-controller="inventoryBalancingController">
                                    <div class="inventory-button-block">
                                        <a href="javascript:void(0);" class="button button-big color-green button-fill" ng-click="balancing.getBalancing()">查看当前库存</a>
                                    </div>
                                    <div class="list-block inset little-top-margin">
                                        <ul>
                                            <li class="item-content">
                                                <div class="item-inner">
                                                    <div class="item-title">库存总数:</div>
                                                    <div class="item-after">{{balancing.inventory}}件</div>
                                                </div>
                                            </li>
                                            <li class="item-content">
                                                <div class="item-inner">
                                                    <div class="item-title">总进货款:</div>
                                                    <div class="item-after">{{balancing.totalPrice}}元</div>
                                                </div>
                                            </li>
                                            <li class="item-content">
                                                <div class="item-inner">
                                                    <div class="item-title">总出货款:</div>
                                                    <div class="item-after">{{balancing.totalPayment}}元</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="inventory-button-block">
                            <a href="<?php echo url('/wd/admin/products') ?>" class="button button-big external color-red button-fill">
                                前往后台管理商品
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Third view     -->
        <div class="view tab" id="view-temp">
            <div class="navbar">
                <div class="navbar-inner">
                    <div class="left sliding">

                    </div>
                    <!-- We need cool sliding animation on title element, so we have additional "sliding" class -->
                    <div class="center">我的信息</div>
                    <div class="right">
                        <a href="#" data-panel="right" class="link icon-only open-panel">
                            <i class="fa fa-user"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="pages navbar-through">
                <div class="page" data-page="personal-page" ng-controller="UserController">
                    <div class="page-content">
                        <div class="content-block avatar-container">
                            <div class="content-block-inner">
                                <div class="avatar"><img src="<?php echo '/img/wd/face/' . Auth::user()->headImg ?>"  /></div>
                                <p>
                                    <span id="user-info">
                                        <?php echo Auth::User()->name ?>
                                    </span>
                                    <a href="#" class="icon-only  prompt-title-ok-cancel" title="修改昵称">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="content-block-title">其他操作</div>
                        <div class="content-block">
                            <div class="row">
                                <div class="col-50">
                                    <a href="#" class="button button-big open-picker" data-picker=".change-password-picker">修改密码</a>
                                </div>
                                <div class="col-50">
                                    <a href="#" class="button button-big open-picker" data-picker=".change-face-picker">修改头像</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Bottom Tabbar  -->
        <div class="toolbar tabbar toolbar-through tabbar-through tabbar-labels">
            <div class="toolbar-inner">
                <a href="#view-bill" class="tab-link active">
                    <i class="fa fa-yen fa-2x"></i>
                    <span class="tabbar-label">记帐</span>
                </a>
                <a href="#view-ws" class="tab-link">
                    <i class="fa fa-list fa-2x"></i>
                    <span class="tabbar-label">库存</span>
                </a>
                <a href="#view-temp" class="tab-link">
                    <i class="fa fa-user fa-2x"></i>
                    <span class="tabbar-label">我</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Picker -->
    <div class="picker-modal change-password-picker">
        <div class="toolbar">
            <div class="toolbar-inner">
                <div class="left"></div>
                <div class="right">
                    <a href="#" class="close-picker">关闭</a>
                </div>
            </div>
        </div>
        <div class="picker-modal-inner">
            <form id="changeNameForm" name="changeNameForm" ng-controller="UserChangePasswordController" ng-submit="password.changePassword()" >
                <div class="content-block-title">
                    修改密码
                </div>
                <div class="list-block">
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-email"></i></div>
                                <div class="item-inner">
                                    <div class="item-input">
                                        <input type="email" name="email" placeholder="请输入用户名" required title="请输入用户名" ng-model="password.email">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-password"></i></div>
                                <div class="item-inner">
                                    <div class="item-input">
                                        <input type="password" name="new_password" placeholder="请输入新密码，最少6位" required title="请输入新密码，最少6位" ng-model="password.new_password" ng-minlength="6">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-password"></i></div>
                                <div class="item-inner">
                                    <div class="item-input">
                                        <input type="password" name="new_password_confirmation" placeholder="请确认新密码，最少6位" required title="请确认新密码，最少6位" ng-model="password.new_password_confirmation" ng-minlength="6">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <input type="submit" class="button" value="修改" ng-disabled="password.old_password==''||password.new_password==''||password.new_password_confirmation==''||password.new_password!=password.new_password_confirmation" />
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
    <div class="picker-modal change-face-picker">
        <div class="toolbar">
            <div class="toolbar-inner">
                <div class="left"></div>
                <div class="right">
                    <a href="#" class="close-picker">关闭</a>
                </div>
            </div>
        </div>
        <div class="picker-modal-inner">
            <form id="changeFaceForm" name="changeFaceForm" ng-controller="UserChangeFaceController" ng-submit="face.changeFace()" enctype="multipart/form-data">
                <div class="content-block-title">更换头像</div>
                <div class="list-block">
                    <ul>
                        <li>
                            <div class="item-content">
                                <div class="item-media"><i class="icon icon-form-name"></i></div>
                                <div class="item-inner">
                                    <input type="file" name="new_face" placeholder="请选择头像" required title="请选择头像" file-model="new_face" accept="image/*">
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item-content">
                                <div class="item-inner">
                                    <input type="submit" class="button" value="更换" />
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
    <!-- Chart Popup -->
    <div class="popup popup-chart">
        <div class="navbar">
            <div class="navbar-inner">
                <div class="left sliding">&nbsp;</div>
                <div class="center sliding"><span class="app-title"></span></div>
                <div class="right">
                    <a href="#" class="link icon-only close-popup">
                        <i class="fa fa-close"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="pages navbar-through">
            <div class="page">
                <div class="page-content">
                    <div class="content-block">
                        <canvas id="canvas" height="100%" width="100%"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Path to your app js-->
    <script data-main="js/main" src="/js/lib/require.js"></script>
  </body>
</html>
