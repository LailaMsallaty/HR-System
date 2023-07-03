<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmployeePunishments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Employee_Punishments', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->foreignId('Employee_Id')->references('id')->on('Employees')
            				->onDelete('cascade')
            				->onUpdate('cascade');
            $table->foreignId('Punishment_Id')->references('id')->on('punishments')
                            ->onDelete('cascade')
                            ->onUpdate('cascade');
			$table->string('Statement');
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
        Schema::dropIfExists('Employee_Punishments');

    }
}
