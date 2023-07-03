<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvancePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Advance_Payments', function (Blueprint $table) {
			$table->bigincrements('id');
            $table->bigInteger('Employee_Id')->unsigned()->nullable();
            $table->bigInteger('Previous_Salary');
            $table->string('Statement');
            $table->biginteger('Advance_Amount');
            $table->biginteger('Remaining_Amount');
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
        Schema::dropIfExists('Advance_Payments');
    }
}
