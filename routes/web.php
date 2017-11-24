<?php

Route::get('/','Home\IndexController@index');

/**
 * 前后台交互路由
 */

Route::group(['namespace'=>'Home'],function(){
    Route::get('login','LoginController@login');
    Route::get('info','IndexController@info');
    /**
     * 听力测试
     */
    Route::match(['get','post'],'listen/listening_test','ListenController@listening_test');
    Route::get('listen/specialized_test','ListenController@specialized_test');
    Route::get('listen/hearing_sense','ListenController@hearing_sense');
    Route::post('listen/result','ListenController@result');
    Route::get('listen/more','ListenController@more');
    Route::get('listen/detail','ListenController@detail');

    /**
     * 预约服务
     */
    Route::match(['get','post'],'service/listening_test','ServiceController@listening_test');
    Route::match(['get','post'],'service/order_maintenance','ServiceController@order_maintenance');
    Route::match(['get','post'],'service/fault_handling','ServiceController@fault_handling');
    Route::match(['get','post'],'service/re_service','ServiceController@re_service');
    Route::get('service/se_notice','ServiceController@se_notice');
    Route::get('service/getCity','ServiceController@getCity');
    Route::get('service/getArea','ServiceController@getArea');
    Route::get('service/getStore','ServiceController@getStore');
    /***
     * 共享助听
     */
    Route::get('share/ideas','ShareController@ideas');
    Route::get('share/hearing_aid','ShareController@hearing_aid');
    //退还设备
    Route::match(['get','post'],'share/return_equipment','ShareController@return_equipment');
    Route::get('share/common_sense','ShareController@common_sense');
    Route::get('share/hearing_map','ShareController@hearing_map');
    Route::get('share/getCity','ServiceController@getCity');
    Route::get('share/getArea','ServiceController@getArea');
    Route::get('share/getStore','ServiceController@getStore');
    /**
     * 助力商城
     */

    Route::get('shop/index','ShopController@index');
    Route::get('shop/display','ShopController@display');
    Route::get('shop/detail','ShopController@detail');
    Route::any('shop/submit_address','ShopController@submit_address');
    Route::get('shop/order','ShopController@order');

    /**
     * 个人中心
     */

    Route::get('announcement','CenterController@announcement');
    Route::get('center/account','CenterController@account');
    Route::get('center/cash','CenterController@cash');
    Route::get('center/record','CenterController@record');
    Route::any('center/cooperation','CenterController@cooperation');
    Route::any('center/free_for','CenterController@free_for');

    /*Route::get('center/wallet','CenterController@wallet');
    Route::get('center/money','CenterController@money');
    Route::get('center/self_order','CenterController@self_order');
    Route::get('center/my_device','CenterController@my_device');
    Route::get('center/get_money','CenterController@get_money');
    Route::get('center/record','CenterController@record');
    Route::get('center/bs_cooperation','CenterController@bs_cooperation');
    Route::get('center/online_service','CenterController@online_service');*/
});

/**
 * web管理端路由
 */
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    //登录的路由
    Route::get('login','LoginController@login');

    Route::post('login_check','LoginController@login_check');
   /* Route::group(['middleware'=>'login'],function(){*/
        Route::any('getCity/{p_code?}','StoreController@getCity');
        Route::any('getArea/{c_code?}','StoreController@getArea');
        //首页路由
        Route::get('index','IndexController@index');
        Route::get('welcome','IndexController@welcome');

        //权限管理路由
        Route::any('privilege/add','PrivilegeController@add');
        Route::any('privilege/index','PrivilegeController@index');
        Route::any('privilege/del/{id?}','PrivilegeController@del');
        Route::any('privilege/edit/{id?}','PrivilegeController@edit');
        //角色管理
        Route::any('role/index','RoleController@index');
        Route::any('role/add','RoleController@add');
        Route::any('role/edit/{id?}','RoleController@edit');
        Route::get('role/del/{id}','RoleController@del');
        //管理员管理
        Route::get('manager/index','ManagerController@index');
        Route::any('manager/add','ManagerController@add');
        Route::any('manager/del/{id?}','ManagerController@del');
        Route::any('manager/edit/{id?}','ManagerController@edit');
        Route::get('manager/stop/{id?}','ManagerController@stop');
        Route::get('manager/start/{id?}','ManagerController@start');
        //门店管理
        Route::get('store/index','StoreController@index');
        Route::any('store/add','StoreController@add');
        Route::any('store/del/{id?}','StoreController@del');
        Route::any('store/edit/{id?}','StoreController@edit');
        //公告管理
        Route::any('announcement/list','AnnouncementController@list');
        Route::any('announcement/add','AnnouncementController@add');
        Route::any('announcement/edit/{id?}','AnnouncementController@edit');
        Route::get('announcement/del/{id?}','AnnouncementController@del');
        Route::get('announcement/detail/{id?}','AnnouncementController@detail');
        //仪器管理
        Route::get('instrument/index','InstrumentController@index');
        Route::any('instrument/add','InstrumentController@add');
        Route::any('instrument/edit/{id?}','InstrumentController@edit');
        Route::any('instrument/del/{id?}','InstrumentController@del');
        //发送短信接口
        Route::any('send_message','InstrumentController@send_message');

        Route::get('question/index','QuestionController@index');
        Route::any('question/add','QuestionController@add');

//    });

});