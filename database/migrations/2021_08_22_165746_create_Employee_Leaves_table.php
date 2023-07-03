<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeLeavesTable extends Migration {

	public function up()
	{
		Schema::create('Employee_Leaves', function(Blueprint $table) {
			$table->bigincrements('id');
            $table->foreignId('Employee_Id')->references('id')->on('Employees')
            				->onDelete('cascade')
            				->onUpdate('cascade');
            $table->foreignId('Leave_Id')->references('id')->on('leaves')
                            ->onDelete('cascade')
                            ->onUpdate('cascade');
			$table->date('Start_Date');
			$table->date('End_Date');
			$table->double('TotalDays');
			$table->integer('Status')->default(0);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Employee_Leaves');
	}
}
