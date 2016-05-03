<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsumingRecordsTalbe extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
            Schema::create('consuming_records', function(Blueprint $table)
		{
			$table->increments('id')->comment('消费编号');
			$table->integer('who')->unsigned()->comment('消费主体');
			$table->integer('category_id')->unsigned()->comment('消费类型编号');
			$table->decimal("amount", 15, 2)->comment('消费金额');
			$table->timestamps("consumption_date")->comment('如果当天没有填写，日后补充时可以补充一下消费日期');
			$table->text("remark")->nullable()->comment('备注');
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
            Schema::drop("consuming_records");
	}

}
