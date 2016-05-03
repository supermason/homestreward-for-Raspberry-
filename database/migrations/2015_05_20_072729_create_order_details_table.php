<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_details', function(Blueprint $table)
		{
			$table->increments('id')->comment('订单详情编号');
                        $table->integer('product_id')->unsigned()->comment('订单相关产品编号');
                        $table->float('sold_price')->unsigned()->comment('本次操作的真实价格');
                        $table->integer('count')->unsigned()->comment('产品数量');
                        $table->integer('order_id')->unsigned()->comment('关联的订单号');
			$table->timestamps();
                        // 创建外键
                        $table->foreign('product_id')->references('id')->on('products');
                        $table->foreign('order_id')->references('id')->on('orders');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_details');
	}

}
