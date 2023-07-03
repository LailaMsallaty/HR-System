<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		// Schema::table('job_seekers', function(Blueprint $table) {
		// 	$table->foreign('Degree_Id')->references('id')->on('job_seeker_degrees')
		// 				->onDelete('cascade')
		// 				->onUpdate('cascade');
        //  $table->foreign('Nationality_JobSeeker_id')->references('id')->on('nationalities')
        //                 ->onDelete('cascade')
        //                 ->onUpdate('cascade');

		// });
	
		Schema::table('Positions', function(Blueprint $table) {
			$table->foreign('Department_Id')->references('id')->on('Departments')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Department_Location', function(Blueprint $table) {
			$table->foreign('Location_Id')->references('id')->on('Locations')
						->onDelete('cascade')
						->onUpdate('cascade');
            $table->foreign('Department_Id')->references('id')->on('Departments')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('Manager_Id')->references('id')->on('Employees')
            ->onDelete('cascade')
            ->onUpdate('cascade');
         });

         Schema::table('Locations', function(Blueprint $table) {
			$table->foreign('City_Id')->references('id')->on('Cities')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Employees', function(Blueprint $table) {
			$table->foreign('Department_Id')->references('id')->on('Departments')
						->onDelete('cascade')
						->onUpdate('cascade');
            $table->foreign('Nationality_Employee_id')->references('id')->on('nationalities')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('Degree_Id')->references('id')->on('Employee_Degree')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('Location_Id')->references('id')->on('Locations')
            ->onDelete('cascade')
            ->onUpdate('cascade');
		});
        Schema::table('Advance_Payments', function(Blueprint $table) {
			$table->foreign('Employee_Id')->references('id')->on('Employees')
						->onDelete('cascade')
						->onUpdate('cascade');
		});


        Schema::table('Cities', function(Blueprint $table) {
			$table->foreign('Country_Id')->references('id')->on('Countries')
						->onDelete('cascade')
						->onUpdate('cascade');
		});



		Schema::table('Employee_Salary', function(Blueprint $table) {
			$table->foreign('Employee_Id')->references('id')->on('Employees')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

		Schema::table('Employee_Role', function(Blueprint $table) {
			$table->foreign('Position_Id')->references('id')->on('Positions')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('Employee_Role', function(Blueprint $table) {
			$table->foreign('Employee_Id')->references('id')->on('Employees')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
        Schema::table('Attachments', function(Blueprint $table) {
			$table->foreign('attachmentable_id')->references('id')->on('Employees')
						->onDelete('cascade')
						->onUpdate('cascade');
		});

	 }

	 public function down()
	 {
	// 	Schema::table('JobSeekers', function(Blueprint $table) {
	// 		$table->dropForeign('JobSeekers_Degree_Id_foreign');
	// 	});
	// 	Schema::table('JobSeeker_Skills', function(Blueprint $table) {
	// 		$table->dropForeign('JobSeeker_Skills_Skill_Id_foreign');
	// 	});
	// 	Schema::table('JobSeeker_Skills', function(Blueprint $table) {
	// 		$table->dropForeign('JobSeeker_Skills_JobSeeker_Id_foreign');
	// 	});
	// 	Schema::table('Seeker_Past_Experience', function(Blueprint $table) {
	// 		$table->dropForeign('Seeker_Past_Experience_JobSeeker_ID_foreign');
	// 	});
	// 	Schema::table('JobSeeker_Awards', function(Blueprint $table) {
	// 		$table->dropForeign('JobSeeker_Awards_JobSeeker_Id_foreign');
	// 	});
	// 	Schema::table('Job_Seeker_Roles', function(Blueprint $table) {
	// 		$table->dropForeign('Job_Seeker_Roles_Position_Id_foreign');
	// 	});
	// 	Schema::table('Job_Seeker_Roles', function(Blueprint $table) {
	// 		$table->dropForeign('Job_Seeker_Roles_JobSeeker_Id_foreign');
	// 	});
		// Schema::table('Position_Requirements', function(Blueprint $table) {
		// 	$table->dropForeign('Position_Requirements_Position_Id_foreign');
		// });
		// Schema::table('Position_Requirements', function(Blueprint $table) {
		// 	$table->dropForeign('Position_Requirements_Requirement_Id_foreign');
		// });
		// Schema::table('Position_Department', function(Blueprint $table) {
		// 	$table->dropForeign('Position_Department_Position_Id_foreign');
		// });
		// Schema::table('Position_Department', function(Blueprint $table) {
		// 	$table->dropForeign('Position_Department_Department_Id_foreign');
		// });
	// 	Schema::table('Department_Location', function(Blueprint $table) {
	// 		$table->dropForeign('Department_Location_Location_Id_foreign');
	// 	});
	// 	Schema::table('Department_Location', function(Blueprint $table) {
	// 		$table->dropForeign('Department_Location_Department_Id_foreign');
	// 	});
		// Schema::table('Employees', function(Blueprint $table) {
		// 	$table->dropForeign('Employees_Department_Id_foreign');
		// });
		// Schema::table('Employees', function(Blueprint $table) {
		// 	$table->dropForeign('Employees_Position_Id_foreign');
		// });
	// 	Schema::table('Employee_Awards', function(Blueprint $table) {
	// 		$table->dropForeign('Employee_Awards_Employee_Id_foreign');
	// 	});
	// 	Schema::table('Employee_Leaves', function(Blueprint $table) {
	// 		$table->dropForeign('Employee_Leaves_Employee_Id_foreign');
	// 	});
	// 	Schema::table('Employee_Leaves', function(Blueprint $table) {
	// 		$table->dropForeign('Employee_Leaves_Leave_Id_foreign');
	// 	});
	// 	Schema::table('Employee_Attendance', function(Blueprint $table) {
	// 		$table->dropForeign('Employee_Attendance_Employee_Id_foreign');
	// 	});
	// 	Schema::table('Employee_Salary', function(Blueprint $table) {
	// 		$table->dropForeign('Employee_Salary_Employee_Id_foreign');
	// 	});
	// 	Schema::table('Emp_Skills', function(Blueprint $table) {
	// 		$table->dropForeign('Emp_Skills_Skill_Id_foreign');
	// 	});
	// 	Schema::table('Emp_Skills', function(Blueprint $table) {
	// 		$table->dropForeign('Emp_Skills_Employee_Id_foreign');
	// 	});
		// Schema::table('Employee_Role', function(Blueprint $table) {
		// 	$table->dropForeign('Employee_Role_Position_Id_foreign');
		// });
		// Schema::table('Employee_Role', function(Blueprint $table) {
		// 	$table->dropForeign('Employee_Role_Employee_Id_foreign');
		// });
	}
}
