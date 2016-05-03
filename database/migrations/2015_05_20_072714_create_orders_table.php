<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id')->comment('订单编号');
                        $table->integer('order_type')->unsigned()->comment('订单类型（1-进货单、2-销售单）');
                        $table->integer('target_id')->unsigned()->comment('关联对象编号（进货关联供应商、销售关联客户）');
                        $table->tinyInteger('status')->unsigned()->comment('订单状态');
                        // 自动创建的created_at作为下单时间
                        // 自动创建的updated_at作为订单状态改变时间，根据status的值来判断是取消、完结或是其他
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
		Schema::drop('orders');
	}

}
