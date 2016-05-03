<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('menu', function(Blueprint $table)
        {
            $table->increments('id')->comment('主键编号');
            $table->string('label')->unique()->comment('菜单名称');
            $table->unsignedInteger('menu_type')->comment('菜单类型：0-一级，以此类推');
            $table->unsignedInteger('product_category')->comment('对应的分类');
            $table->string('direct_url')->comment('直接跳转到的页面');
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
        //
        Schema::drop("menu");
    }
}
