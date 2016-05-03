<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_categories', function(Blueprint $table)
		{
			$table->increments('id')->comment('客户类型编号');
                        $table->string('name')->unique()->comment('客户类型名称（暂时只有散户、代理之分）');
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
		Schema::drop('customer_categories');
	}

}
