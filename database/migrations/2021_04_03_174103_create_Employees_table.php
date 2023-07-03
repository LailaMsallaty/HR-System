<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration {

	public function up()
	{
		Schema::create('Employees', function(Blueprint $table) {
			$table->bigincrements('id');
			$table->string('FName');
			$table->string('LName');
			$table->date('BirthDate');
			$table->string('email')->unique();
            $table->string('Number');
            $table->string('Code')->unique();
            $table->biginteger('Salary')->default('0');
            $table->bigInteger('Location_Id')->unsigned();
            $table->bigInteger('Nationality_Employee_id')->unsigned();
            $table->bigInteger('Degree_Id')->unsigned();
			$table->string('Skills');
			$table->string('Gender');
			$table->date('HireDate');
			$table->string('Address');
			$table->bigInteger('Department_Id')->unsigned();
            $table->tinyInteger('Manager');
			$table->string('Trainee');
			$table->integer('Years_Of_Experience');
            $table->string('ImageName');
            $table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Employees');
	}
}
