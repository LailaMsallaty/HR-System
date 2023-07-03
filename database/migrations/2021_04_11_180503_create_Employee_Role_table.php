<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeeRoleTable extends Migration {

	public function up()
	{
		Schema::create('Employee_Role', function(Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('Position_Id')->unsigned();
			$table->bigInteger('Employee_Id')->unsigned();
            $table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('Employee_Role');
	}
}
