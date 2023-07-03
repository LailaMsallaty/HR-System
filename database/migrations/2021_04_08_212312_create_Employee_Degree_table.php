<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeDegreeTable extends Migration {

	public function up()
	{
		Schema::create('Employee_Degree', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('Level');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Employee_Degree');
	}
}
