<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('菜单名称');
            $table->string('route')->nullable()->comment('路由名称，与链接任选其一');
            $table->string('url')->nullable()->comment('链接，与路由任选其一');
            $table->string('permission')->nullable()->comment('菜单对应权限');
            $table->integer('parent_id')->default(0)->comment('上级菜单ID');
            $table->integer('icon_id')->nullable()->comment('图标ID');
            $table->integer('sort')->default(0)->comment('排序');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
