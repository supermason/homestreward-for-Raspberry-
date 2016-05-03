<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
			$table->increments('id')->comment('客户编号');
                        $table->string('name')->comment('客户名称');
                        $table->string('phoneNum')->nullable()->comment('联系电话');
                        $table->string('wx')->nullable()->comment('微信号');
                        $table->string('address')->nullable()->comment('地址');
                        $table->integer('customer_category_id')->unsigned()->comment('客户类型编号');
			$table->timestamps();
                        $table->softDeletes();
                        // 创建外键
                        $table->foreign('customer_category_id')->references('id')->on('customer_categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('customers');
	}

}
