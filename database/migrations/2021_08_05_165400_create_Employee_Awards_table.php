<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Employee_Awards', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->foreignId('Employee_Id')->references('id')->on('Employees')
            				->onDelete('cascade')
            				->onUpdate('cascade');
            $table->foreignId('Award_Id')->references('id')->on('awards')
                            ->onDelete('cascade')
                            ->onUpdate('cascade');
			$table->string('Gift');
			$table->integer('Cash_Prize');
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
        Schema::dropIfExists('Employee_Awards');
    }
}
