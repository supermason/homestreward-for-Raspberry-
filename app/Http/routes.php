<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('auth.login');
//});

Route::get('/', ['middleware' => 'auth', function() {
    return view('homestreward');
}]);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);


/*
 |--------------------------------------------------------------------------
 | 测试路由
 |--------------------------------------------------------------------------
 */
Route::group(['prefix' => 'test', 'namespace' => 'Test'], function(){
    Route::resource("tests", "TestController");
});

Route::group(['middleware' => ['web', 'auth']], function() {

    /*
     |--------------------------------------------------------------------------
     | 记帐总路由
     |--------------------------------------------------------------------------
     */
    Route::group(['prefix' => 'bill', 'namespace' => 'Bill'], function() {

        Route::get('/', 'BillController@index');
        Route::get('/search', 'BillController@search');
        Route::get('/search/{year}/{month}/{day}', 'BillController@searchByDate')->where(['year', 'month', 'day'], '[0-9]+');
        Route::get('/total/{year}/{month?}', 'BillController@total');
        Route::get('/chart/{year}/{month?}', 'BillController@chart');
        Route::post('/new', 'BillController@store');

        // 消费配置相关
        Route::group(['prefix' => 'setting'], function(){
            Route::get('/', function(){
                return view('bill.settings');
            });
            Route::get('/cc', 'BillSettingController@index');
            Route::post("/new", 'BillSettingController@store');
        });
    });

    /*
     |--------------------------------------------------------------------------
     | 库存总路由
     |--------------------------------------------------------------------------
     */
    Route::group(['prefix' => 'inventory', 'namespace' => 'Inventory'], function() {
        Route::get("/search/{keywords}", "InventoryController@search");
        Route::put("/in", "InventoryController@inventoryIn");
        Route::put("/out", "InventoryController@inventoryOut");
        Route::get("/balancing", "InventoryController@balancing");
    });

    /*
     |--------------------------------------------------------------------------
     | 用户总路由
     |--------------------------------------------------------------------------
     */
    Route::group(['prefix' => 'user', 'namespace' => 'User'], function() {
//        Route::resource("/", "UserController", ['only' => ['update']]);
        Route::group(['prefix' => 'edit'], function() {
            Route::put("/name", "UserController@update");
            Route::put("/password", "UserController@changePassword");
            Route::post('/face', 'UserController@changeFace');
        });
    });
});

/*
 |--------------------------------------------------------------------------
 | 统计app异常信息总路由
 |--------------------------------------------------------------------------
 */
Route::group(['prefix' => 'matchstatistic', 'namespace' => 'MatchStatistic'], function() {
    Route::resource("/exception", 'ExceptionInfoController', ['only' => ['index', 'create', 'store', 'show']]);
});

/*
 |--------------------------------------------------------------------------
 | 微店总路由
 |--------------------------------------------------------------------------
 */
Route::group(['prefix' => 'wd', 'namespace' => 'WD'], function() {

    /*
     |--------------------------------------------------------------------------
     | 微店产品展示
     |--------------------------------------------------------------------------
     */
    Route::get("/", "WDController@index");
    Route::get("/search/{category}/{keyword?}", "WDController@searchByCategory")->where('category', '[0-9]+');
    Route::get("/latest/{category}", "WDController@latestIndex")->where('category', '[0-9]+');
    Route::get("/detail/{id}", "WDController@show")->where('id', '[0-9]+');

    /*
     |--------------------------------------------------------------------------
     | 微店管理后台
     |--------------------------------------------------------------------------
     */
    Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function() {
        // 主界面无需登录
        Route::get("/", "WDAdminController@index");
        // 其他界面必须登陆后才可以访问
        Route::group(['middleware' => ['web', 'auth']], function() {
            // 产品相关
            Route::resource("products", "ProductsController");
            // 活动相关
            Route::resource("activities", "ActivitiesController");
//            Route::group(['prefix' => 'activities'], function(){
//                Route::resource("/", "ActivitiesController");
//            });
            // 店铺信息相关
            Route::resource("info", 'WdInfoController', ['only' => ['edit', 'update']]);
        });
    });

});
