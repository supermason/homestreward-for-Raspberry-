<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWdInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("wd_info", function(Blueprint $table)
        {
//            $table->increments('id')->comment('主键编号');
//            $table->unsignedInteger('activity_id')->comment('打折信息编号');
//            $table->unsignedInteger('product_id')->comment('参加折扣活动的商品编号');
//            $table->timestamps();
//
//            $table->foreign("activity_id")->references("id")->on("activities");
//            $table->foreign("product_id")->references("id")->on("products");
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
        Schema::drop('wd_info');
    }
}
