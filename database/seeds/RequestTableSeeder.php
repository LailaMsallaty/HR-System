<?php

use Illuminate\Database\Seeder;
use App\empRequest;
use Illuminate\Support\Facades\DB;

class RequestTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('requests')->delete();

        $requests = [

            [
                'en'=> 'Request for Resignation',
                'ar'=> ' إستقالة'
            ],
            [

                'en'=> 'Transfer Request',
                'ar'=> ' إنتقال'
            ],
            [

                'en'=> 'Paying Avanced Request',
                'ar'=> ' دفع سلفة'
            ],
            [

                'en'=> 'Edit in an employee record',
                'ar'=> 'تعديل في سجل الموظف'
            ],
            [

                'en'=> 'Paycheck Pickup',
                'ar'=> 'استلام شيك الراتب'
            ],
            [

                'en'=>' Employment Verification',
                'ar'=>'إثبات وظيفي'
            ]

            ];

            foreach ($requests as $n) {
                empRequest::create(['Name' => $n]);
            }

    }
}
