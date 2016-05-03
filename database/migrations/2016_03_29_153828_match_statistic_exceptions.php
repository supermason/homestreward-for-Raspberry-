<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MatchStatisticExceptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create("match_statistic_exceptions", function(Blueprint $table)
        {
            $table->increments('id')->comment('主键编号');
            $table->string('device')->comment('设备名称');
            $table->string('system_version')->comment('系统版本');
            $table->string('title')->comment("标题");
            $table->text('content')->comment('异常信息');

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
        Schema::drop('match_statistic_exceptions');
    }
}
