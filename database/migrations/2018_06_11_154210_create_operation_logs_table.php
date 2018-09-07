<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operation_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->comment('操作人员id');
            $table->string('route',50)->comment('操作路由');
            $table->string('name',50)->comment('路由名称');
            $table->string('type',50)->comment('访问类型');
            $table->text('parameter')->nullable()->comment('访问参数');
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
        Schema::dropIfExists('operation_logs');
    }
}
