<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("inventory_log", function(Blueprint $table)
        {
            $table->increments('id')->comment('主键编号');
            $table->unsignedInteger('product_id')->comment('商品编号');
            $table->unsignedInteger('count')->comment('数量');
            $table->decimal('price')->comment("价格");
            $table->unsignedInteger('type')->comment('1-进货|2-出货');
            $table->string('info')->nullable()->comment('备注一些东西');

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
        Schema::drop('inventory_log');

    }
}
