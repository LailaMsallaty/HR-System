<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepartmentsTable extends Migration {

	public function up()
	{
		Schema::create('Departments', function(Blueprint $table) {
			$table->bigincrements('id');
			$table->string('Name');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Departments');
	}
}
