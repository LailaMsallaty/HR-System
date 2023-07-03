<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\EmployeeDegree;
class EmployeeDegreeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Employee_Degree')->delete();
        $degrees = [
            ['en'=> 'Student', 'ar'=> ' طالب'],
            ['en'=> 'Bachelor’s Degree', 'ar'=> ' باكلوريوس'],
            ['en'=> 'Master’s Degree', 'ar'=> 'ماجيستير'],
            ['en'=> 'Doctoral', 'ar'=> ' دكتوراه'],
        ];
        foreach ($degrees as $S) {
            EmployeeDegree::create(['Level' => $S]);
        }
    }
}
