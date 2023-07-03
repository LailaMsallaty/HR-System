<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobSeekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_seekers', function (Blueprint $table) {
            $table->increments('id');
			$table->string('City');
			$table->string('FName');
			$table->string('LName');
            $table->string('Email')->unique();
			$table->tinyInteger('Willing_Remotly_Job');
            $table->string('Address_JobSeeker');
            $table->bigInteger('Nationality_JobSeeker_id')->unsigned();
			$table->bigInteger('Degree_Id')->unsigned();
			$table->integer('Year_Of_Degree');
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
        Schema::dropIfExists('job_seekers');
    }
}
