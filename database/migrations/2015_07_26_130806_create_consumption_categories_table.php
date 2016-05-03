<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumptionCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('consumption_categories', function(Blueprint $table)
		{
			$table->increments('id')->comment('消费类型编号');
			$table->string('name')->unique()->comment('消费类型名称（可以自行填充）');
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
		Schema::drop('consumption_categories');
	}

}
