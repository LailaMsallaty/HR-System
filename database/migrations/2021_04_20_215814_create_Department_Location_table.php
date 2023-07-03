<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDepartmentLocationTable extends Migration {

	public function up()
	{
		Schema::create('Department_Location', function(Blueprint $table) {
			$table->increments('id');
			$table->bigInteger('Location_Id')->unsigned();
			$table->bigInteger('Department_Id')->unsigned();
			$table->bigInteger('Manager_Id')->unsigned()->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Department_Location');
	}
}
