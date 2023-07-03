<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeSalaryTable extends Migration {

	public function up()
	{
		Schema::create('Employee_Salary', function(Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('Employee_Id')->unsigned();
            $table->bigInteger('Sum_Advances');
			$table->double('Taxes');
			$table->double('Insurance');
			$table->double('Bonus')->default('0');
			$table->double('Total');
            $table->date('Start_Date');
			$table->date('End_Date');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Employee_Salary');
	}
}
