<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePositionsTable extends Migration {

	public function up()
	{
		Schema::create('Positions', function(Blueprint $table) {
			$table->bigincrements('id');
			$table->string('Role');
			$table->tinyInteger('Status');
			$table->biginteger('Salary');
			$table->string('FT_PT');
			$table->string('Requirements')->nullable();
			$table->bigInteger('Department_Id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Positions');
	}
}
