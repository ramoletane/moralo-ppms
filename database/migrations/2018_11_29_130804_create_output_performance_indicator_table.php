<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutputPerformanceIndicatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('output_performance_indicators', function (Blueprint $table) {
            $table->increments('id');
            $table->string('indicator_baseline');
            $table->string('indicator_target');
            $table->integer('output_id');
            $table->integer('indicator_id');
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
        Schema::dropIfExists('output_performance_indicators');
    }
}
