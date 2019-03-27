<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceAssessmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->date('assessment_date');
            $table->string('observation',1000);
            $table->string('response',1000);
            $table->integer('observer_id');
            $table->integer('responder_id');
            $table->integer('output_id');
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
        Schema::dropIfExists('performance_assessments');
    }
}
