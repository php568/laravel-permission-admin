<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_name',255)->comment('文件名称');
            $table->string('file_code',255)->comment('文件编码');
            $table->integer('secret_type')->default(0)->comment('密级：机密-1、绝密-2、秘密-3、内部公开-0');
            $table->integer('file_type')->default(0)->comment('文件类型：生产类-1、商务类-2、研发类-3、战略类-4、其他类-0');
            $table->integer('print_type')->default(0)->comment('打印：允许-1、不允许-0');
            $table->integer('label_type')->default(0)->comment('标签：显示-1、隐藏-0');
            $table->integer('operate_type')->default(0)->comment('操作：添加-1、修改-2、发送-3、无-0');
            $table->string('creator')->default('')->comment('创建人');
            $table->string('creator_dep',20)->default('')->comment('创建人部门');
            $table->string('modifier')->default('')->comment('修改人');
            $table->string('modifier_dep',20)->default('')->comment('修改人部门');
            $table->text('change_item')->default('')->comment('变更项，只记录变更的内容，标识出来时添加、修改、发送');
            //变更项内容更分为
            //（密级：内部公开，秘密、机密、绝密）
            //（类型：生产类、商务类、研发类、战略类、其他类）
            //（打印：允许、不允许）
            //（标签类型：显示标签、隐藏标签）
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
        Schema::dropIfExists('tools_logs');
    }
}
