<?php
//登录、退出
Route::group(['namespace'=>'Admin','prefix'=>'admin'],function (){
    Route::get('login','LoginController@showLoginForm')->name('login');
    Route::post('login','LoginController@login')->name('admin.login');
    Route::get('logout','LoginController@logout')->name('logout');

    //找回密码
    Route::get('password/email','ForgotPasswordController@showLinkRequestForm')->name('password.email');
    Route::post('password/send','ForgotPasswordController@sendResetLinkEmail')->name('password.send');

    //重置密码
    Route::get('password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset','ResetPasswordController@reset')->name('password.update');

});

//后台公共部分
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>'auth'],function (){
    Route::get('/','IndexController@index')->name('admin.index');
    Route::get('index','IndexController@index')->name('admin.index');
    //图标
    Route::get('icons','IndexController@icons')->name('admin.icons');
    Route::get('logs','IndexController@logs')->name('admin.logs');
    Route::get('logs/data','IndexController@logData')->name('admin.logs.data');
});

//系统管理
Route::group(['namespace'=>'Admin','prefix'=>'admin','middleware'=>['auth','permission:system.manage']],function (){
    //数据表格接口
    Route::get('data','IndexController@data')->name('admin.data')->middleware('permission:system.role|system.user|system.permission|system.dept|system.toolslog');
    //用户管理
    Route::group(['middleware'=>['permission:system.user']],function (){
        Route::get('user','UserController@index')->name('admin.user');
        //添加
        Route::get('user/create','UserController@create')->name('admin.user.create')->middleware('permission:system.user.create');
        Route::post('user/store','UserController@store')->name('admin.user.store')->middleware('permission:system.user.create');
        //编辑
        Route::get('user/{id}/edit','UserController@edit')->name('admin.user.edit')->middleware('permission:system.user.edit');
        Route::put('user/{id}/update','UserController@update')->name('admin.user.update')->middleware('permission:system.user.edit');
        //删除
        Route::delete('user/destroy','UserController@destroy')->name('admin.user.destroy')->middleware('permission:system.user.destroy');
        //分配角色
        Route::get('user/{id}/role','UserController@role')->name('admin.user.role')->middleware('permission:system.user.role');
        Route::put('user/{id}/assignRole','UserController@assignRole')->name('admin.user.assignRole')->middleware('permission:system.user.role');
        //分配权限
        Route::get('user/{id}/permission','UserController@permission')->name('admin.user.permission')->middleware('permission:system.user.permission');
        Route::put('user/{id}/assignPermission','UserController@assignPermission')->name('admin.user.assignPermission')->middleware('permission:system.user.permission');
    });
    //角色管理
    Route::group(['middleware'=>'permission:system.role'],function (){
        Route::get('role','RoleController@index')->name('admin.role');
        //添加
        Route::get('role/create','RoleController@create')->name('admin.role.create')->middleware('permission:system.role.create');
        Route::post('role/store','RoleController@store')->name('admin.role.store')->middleware('permission:system.role.create');
        //编辑
        Route::get('role/{id}/edit','RoleController@edit')->name('admin.role.edit')->middleware('permission:system.role.edit');
        Route::put('role/{id}/update','RoleController@update')->name('admin.role.update')->middleware('permission:system.role.edit');
        //删除
        Route::delete('role/destroy','RoleController@destroy')->name('admin.role.destroy')->middleware('permission:system.role.destroy');
        //分配权限
        Route::get('role/{id}/permission','RoleController@permission')->name('admin.role.permission')->middleware('permission:system.role.permission');
        Route::put('role/{id}/assignPermission','RoleController@assignPermission')->name('admin.role.assignPermission')->middleware('permission:system.role.permission');
    });
    //权限管理
    Route::group(['middleware'=>'permission:system.permission'],function (){
        Route::get('permission','PermissionController@index')->name('admin.permission');
        //添加
        Route::get('permission/create','PermissionController@create')->name('admin.permission.create')->middleware('permission:system.permission.create');
        Route::post('permission/store','PermissionController@store')->name('admin.permission.store')->middleware('permission:system.permission.create');
        //编辑
        Route::get('permission/{id}/edit','PermissionController@edit')->name('admin.permission.edit')->middleware('permission:system.permission.edit');
        Route::put('permission/{id}/update','PermissionController@update')->name('admin.permission.update')->middleware('permission:system.permission.edit');
        //删除
        Route::delete('permission/destroy','PermissionController@destroy')->name('admin.permission.destroy')->middleware('permission:system.permission.destroy');
    });
    //菜单管理
    Route::group(['middleware'=>'permission:system.menu'],function (){
        Route::get('menu','MenuController@index')->name('admin.menu');
        Route::get('menu/data','MenuController@data')->name('admin.menu.data');
        //添加
        Route::get('menu/create','MenuController@create')->name('admin.menu.create')->middleware('permission:system.menu.create');
        Route::post('menu/store','MenuController@store')->name('admin.menu.store')->middleware('permission:system.menu.create');
        //编辑
        Route::get('menu/{id}/edit','MenuController@edit')->name('admin.menu.edit')->middleware('permission:system.menu.edit');
        Route::put('menu/{id}/update','MenuController@update')->name('admin.menu.update')->middleware('permission:system.menu.edit');
        //删除
        Route::delete('menu/destroy','MenuController@destroy')->name('admin.menu.destroy')->middleware('permission:system.menu.destroy');
    });
    //部门管理
    Route::group(['middleware' => 'permission:system.dept'], function () {
        Route::get('dept/data', 'DeptController@data')->name('admin.dept.data');
        Route::get('dept', 'DeptController@index')->name('admin.dept');
        //添加部门
        Route::get('dept/create', 'DeptController@create')->name('admin.dept.create')->middleware('permission:system.dept.create');
        Route::post('dept/store', 'DeptController@store')->name('admin.dept.store')->middleware('permission:system.dept.create');
        //编辑部门
        Route::get('dept/{id}/edit', 'DeptController@edit')->name('admin.dept.edit')->middleware('permission:system.dept.edit');
        Route::put('dept/{id}/update', 'DeptController@update')->name('admin.dept.update')->middleware('permission:system.dept.edit');
        //删除部门
        Route::delete('dept/destroy', 'DeptController@destroy')->name('admin.dept.destroy')->middleware('permission:system.dept.destroy');
    });
    //工具日志管理
    Route::group(['middleware' => 'permission:system.toolslog'], function () {
        Route::get('toolslog/data', 'ToolsLogController@data')->name('admin.toolslog.data');
        Route::get('toolslog', 'ToolsLogController@index')->name('admin.toolslog');
        //添加工具日志
        Route::get('toolslog/create', 'ToolsLogController@create')->name('admin.toolslog.create')->middleware('permission:system.toolslog.create');
        Route::post('toolslog/store', 'ToolsLogController@store')->name('admin.toolslog.store')->middleware('permission:system.toolslog.create');
        //编辑工具日志
        Route::get('toolslog/{id}/edit', 'ToolsLogController@edit')->name('admin.toolslog.edit')->middleware('permission:system.toolslog.edit');
        Route::put('toolslog/{id}/update', 'ToolsLogController@update')->name('admin.toolslog.update')->middleware('permission:system.toolslog.edit');
        //删除工具日志
        Route::delete('toolslog/destroy', 'ToolsLogController@destroy')->name('admin.toolslog.destroy')->middleware('permission:system.toolslog.destroy');
    });
});

//资讯管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:zixun.manage']], function () {
    //分类管理
    Route::group(['middleware' => 'permission:zixun.category'], function () {
        Route::get('category/data', 'CategoryController@data')->name('admin.category.data');
        Route::get('category', 'CategoryController@index')->name('admin.category');
        //添加分类
        Route::get('category/create', 'CategoryController@create')->name('admin.category.create')->middleware('permission:zixun.category.create');
        Route::post('category/store', 'CategoryController@store')->name('admin.category.store')->middleware('permission:zixun.category.create');
        //编辑分类
        Route::get('category/{id}/edit', 'CategoryController@edit')->name('admin.category.edit')->middleware('permission:zixun.category.edit');
        Route::put('category/{id}/update', 'CategoryController@update')->name('admin.category.update')->middleware('permission:zixun.category.edit');
        //删除分类
        Route::delete('category/destroy', 'CategoryController@destroy')->name('admin.category.destroy')->middleware('permission:zixun.category.destroy');
    });
    //文章管理
    Route::group(['middleware' => 'permission:zixun.article'], function () {
        Route::get('article/data', 'ArticleController@data')->name('admin.article.data');
        Route::get('article', 'ArticleController@index')->name('admin.article');
        //添加
        Route::get('article/create', 'ArticleController@create')->name('admin.article.create')->middleware('permission:zixun.article.create');
        Route::post('article/store', 'ArticleController@store')->name('admin.article.store')->middleware('permission:zixun.article.create');
        //编辑
        Route::get('article/{id}/edit', 'ArticleController@edit')->name('admin.article.edit')->middleware('permission:zixun.article.edit');
        Route::put('article/{id}/update', 'ArticleController@update')->name('admin.article.update')->middleware('permission:zixun.article.edit');
        //删除
        Route::delete('article/destroy', 'ArticleController@destroy')->name('admin.article.destroy')->middleware('permission:zixun.article.destroy');
    });
    //标签管理
    Route::group(['middleware' => 'permission:zixun.tag'], function () {
        Route::get('tag/data', 'TagController@data')->name('admin.tag.data');
        Route::get('tag', 'TagController@index')->name('admin.tag');
        //添加
        Route::get('tag/create', 'TagController@create')->name('admin.tag.create')->middleware('permission:zixun.tag.create');
        Route::post('tag/store', 'TagController@store')->name('admin.tag.store')->middleware('permission:zixun.tag.create');
        //编辑
        Route::get('tag/{id}/edit', 'TagController@edit')->name('admin.tag.edit')->middleware('permission:zixun.tag.edit');
        Route::put('tag/{id}/update', 'TagController@update')->name('admin.tag.update')->middleware('permission:zixun.tag.edit');
        //删除
        Route::delete('tag/destroy', 'TagController@destroy')->name('admin.tag.destroy')->middleware('permission:zixun.tag.destroy');
    });
});
//配置管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:config.manage']], function () {
    //站点配置
    Route::group(['middleware' => 'permission:config.site'], function () {
        Route::get('site', 'SiteController@index')->name('admin.site');
        Route::put('site', 'SiteController@update')->name('admin.site.update')->middleware('permission:config.site.update');
    });
    //广告位
    Route::group(['middleware' => 'permission:config.position'], function () {
        Route::get('position/data', 'PositionController@data')->name('admin.position.data');
        Route::get('position', 'PositionController@index')->name('admin.position');
        //添加
        Route::get('position/create', 'PositionController@create')->name('admin.position.create')->middleware('permission:config.position.create');
        Route::post('position/store', 'PositionController@store')->name('admin.position.store')->middleware('permission:config.position.create');
        //编辑
        Route::get('position/{id}/edit', 'PositionController@edit')->name('admin.position.edit')->middleware('permission:config.position.edit');
        Route::put('position/{id}/update', 'PositionController@update')->name('admin.position.update')->middleware('permission:config.position.edit');
        //删除
        Route::delete('position/destroy', 'PositionController@destroy')->name('admin.position.destroy')->middleware('permission:config.position.destroy');
    });
    //广告信息
    Route::group(['middleware' => 'permission:config.advert'], function () {
        Route::get('advert/data', 'AdvertController@data')->name('admin.advert.data');
        Route::get('advert', 'AdvertController@index')->name('admin.advert');
        //添加
        Route::get('advert/create', 'AdvertController@create')->name('admin.advert.create')->middleware('permission:config.advert.create');
        Route::post('advert/store', 'AdvertController@store')->name('admin.advert.store')->middleware('permission:config.advert.create');
        //编辑
        Route::get('advert/{id}/edit', 'AdvertController@edit')->name('admin.advert.edit')->middleware('permission:config.advert.edit');
        Route::put('advert/{id}/update', 'AdvertController@update')->name('admin.advert.update')->middleware('permission:config.advert.edit');
        //删除
        Route::delete('advert/destroy', 'AdvertController@destroy')->name('admin.advert.destroy')->middleware('permission:config.advert.destroy');
    });
});
//会员管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:member.manage']], function () {
    //账号管理
    Route::group(['middleware' => 'permission:member.member'], function () {
        Route::get('member/data', 'MemberController@data')->name('admin.member.data');
        Route::get('member', 'MemberController@index')->name('admin.member');
        //添加
        Route::get('member/create', 'MemberController@create')->name('admin.member.create')->middleware('permission:member.member.create');
        Route::post('member/store', 'MemberController@store')->name('admin.member.store')->middleware('permission:member.member.create');
        //编辑
        Route::get('member/{id}/edit', 'MemberController@edit')->name('admin.member.edit')->middleware('permission:member.member.edit');
        Route::put('member/{id}/update', 'MemberController@update')->name('admin.member.update')->middleware('permission:member.member.edit');
        //删除
        Route::delete('member/destroy', 'MemberController@destroy')->name('admin.member.destroy')->middleware('permission:member.member.destroy');
    });
});
//消息管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'permission:message.manage']], function () {
    //消息管理
    Route::group(['middleware' => 'permission:message.message'], function () {
        Route::get('message/data', 'MessageController@data')->name('admin.message.data');
        Route::get('message/getUser', 'MessageController@getUser')->name('admin.message.getUser');
        Route::get('message', 'MessageController@index')->name('admin.message');
        //添加
        Route::get('message/create', 'MessageController@create')->name('admin.message.create')->middleware('permission:message.message.create');
        Route::post('message/store', 'MessageController@store')->name('admin.message.store')->middleware('permission:message.message.create');
        //删除
        Route::delete('message/destroy', 'MessageController@destroy')->name('admin.message.destroy')->middleware('permission:message.message.destroy');
        //我的消息
        Route::get('mine/message', 'MessageController@mine')->name('admin.message.mine')->middleware('permission:message.message.mine');
        Route::post('message/{id}/read', 'MessageController@read')->name('admin.message.read')->middleware('permission:message.message.mine');

        Route::get('message/count', 'MessageController@getMessageCount')->name('admin.message.get_count');
    });

});