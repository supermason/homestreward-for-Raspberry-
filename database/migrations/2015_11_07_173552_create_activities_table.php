<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('activities', function(Blueprint $table)
        {
            $table->increments('id')->comment('主键编号');
            $table->double('strength')->comment('打折力度');
            $table->unsignedInteger('reason')->comment('打折的原因');
            $table->timestamp("start_date")->comment('起始时间');
            $table->timestamp("end_date")->comment('结束时间');
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
        Schema::drop('activities');
    }
}
