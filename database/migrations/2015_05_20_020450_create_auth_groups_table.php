<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('auth_groups', function(Blueprint $table)
		{
                    // laravel 会自动假设每张表都有一个数值类型的id键，并自动将其设置为主键
                    // 所以对id列必须调用increments
			$table->increments('id')->comment('主键，自增列，权限组编号');
                        $table->string('name')->unique()->comment('权限组名称');
			$table->timestamps();
                        
//                        \Illuminate\Console\Command::in
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('auth_groups');
	}

}
