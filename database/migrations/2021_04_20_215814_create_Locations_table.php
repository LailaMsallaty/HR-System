<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationsTable extends Migration {

	public function up()
	{
		Schema::create('Locations', function(Blueprint $table) {
			$table->bigincrements('id');
            $table->bigInteger('City_Id')->unsigned();
			$table->string('Address');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('Locations');
	}
}
