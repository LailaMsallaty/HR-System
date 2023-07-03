<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_requests', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->foreignId('Employee_Id')->references('id')->on('Employees')
            				->onDelete('cascade')
            				->onUpdate('cascade');
            $table->foreignId('Request_Id')->references('id')->on('requests')
                            ->onDelete('cascade')
                            ->onUpdate('cascade');
			$table->string('Statement');
            $table->string('Reply_Statement')->nullable();
            $table->string('HR_Comment')->nullable();
            $table->integer('Status')->default(0);
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
        Schema::dropIfExists('employee_requests');
    }
}
