<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('suppliers', function(Blueprint $table)
		{
			$table->increments('id')->comment('供应商编号');
                        $table->string('name')->unique()->comment('供应商名称');
                        $table->string('address')->nullable()->comment('供应商地址');
                        $table->string('wx_num')->nullable()->comment('供应商微信号');
                        $table->string('phone_num')->nullable()->comment('供应商手机号');
                        $table->string('qq')->nullable()->comment('供应商QQ号');
			$table->timestamps();
                        $table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('suppliers');
	}

}
