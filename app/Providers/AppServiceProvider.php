<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
        $menus = \App\Models\Menu::with(['subMenus'=>function($query){
            $query->with('icon')->orderBy('sort','desc');
        },'icon'])->where('parent_id',0)->orderBy('sort','desc')->get();
        view()->share('menus',$menus);
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
