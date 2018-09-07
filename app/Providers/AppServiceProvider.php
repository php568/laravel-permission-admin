<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //左侧菜单
        view()->composer('admin.base',function($view){
            $menus = \App\Models\Permission::with([
                'childs'=>function($query){
                    $query->with('icon')->where('display','1');
                },'icon'])
                ->where('parent_id',0)
                ->where('display','1')
                ->orderBy('sort','desc')
                ->get();
            $unreadMessage = \App\Models\Message::where('read',1)->where('accept_uuid',auth()->user()->uuid)->count();
            $view->with('menus',$menus);
            $view->with('unreadMessage',$unreadMessage);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
