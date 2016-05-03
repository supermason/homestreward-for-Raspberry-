<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('home', function(Blueprint $table)
        {
            $table->increments('id')->comment('主键编号');
            $table->string('name')->unique()->comment('家庭名称');
            $table->string('address')->comment('地址');
            $table->string('phone')->comment('联系电话');
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
        Schema::drop("home");
    }
}
