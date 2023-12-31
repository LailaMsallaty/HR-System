<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->foreignId('Employee_Id')->references('id')->on('Employees')
            				->onDelete('cascade')
            				->onUpdate('cascade');
            $table->string('Title');
			$table->integer('Sender_id');
            $table->string('Description')->nullable();;
            $table->string('Comment')->nullable();
            $table->string('Sent_Task_Attachment')->nullable();
            $table->string('Received_Task_Attachment')->nullable();
            $table->date('Start_Date');
			$table->date('End_Date');
			$table->integer('Duration');
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
        Schema::dropIfExists('tasks');
    }
}
