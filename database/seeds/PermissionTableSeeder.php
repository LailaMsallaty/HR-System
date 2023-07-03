<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        $permissions =  [

            [
                'en'=> 'General_Management',
                'ar'=> 'إدارة_عامة'
            ],
            [

                'en'=> 'Manage_Employees',
                'ar'=> 'إدارة_الموظفين'
            ],
            [

                'en'=> 'Employee_Processes',
                'ar'=> 'العمليات_على_الموظف'
            ],
            [

                'en'=>'Reports',
                'ar'=>'التقارير'
            ],
            [

                'en'=>'Users',
                'ar'=>'المستخدمين'
            ],
            [

                'en'=>'Roles',
                'ar'=>'الأدوار'
            ],
            [

                'en'=> 'Pay_Salary',
                'ar'=> 'دفع_راتب'
            ],
            [

                'en'=> 'Salaries',
                'ar'=> 'الرواتب'
            ],
            [

                'en'=> 'Employee_Salaries',
                'ar'=> 'رواتب_الموظف'
            ],
            [

                'en'=> 'Salaries_List',
                'ar'=> 'قائمة_الرواتب'
            ],
            [

                'en'=> 'Edit_Delete_Salary',
                'ar'=> 'تعديل_حذف_راتب'
            ],
            [

                'en'=> 'Pay_Advance',
                'ar'=> 'دفع_سلفة'
            ],
            [

                'en'=> 'Edit_Advance',
                'ar'=> 'تعديل_سلفة'
            ],
            [

                'en'=> 'Delete_Advance',
                'ar'=> 'حذف_سلفة'
            ],
            [

                'en'=> 'Resigned_Requests',
                'ar'=> 'طلبات_الاستقالة'
            ],
            [

                'en'=> 'Add_Resignation',
                'ar'=> 'إضافة_استقالة'
            ],
            [

                'en'=> 'Show_Resigned_Employees',
                'ar'=> 'عرض_الموظفين_المستقيلين'
            ],
            [

                'en'=> 'Resigned_Employees_Processes',
                'ar'=> 'عمليات_الموظفين_المستقيلين'
            ],
            [

                'en'=> 'Punishments',
                'ar'=> 'العقوبات'

            ],

            [

                'en'=>'Impose_Punishment',
                'ar'=>'فرض_عقوبة'
            ],
            [

                'en'=>'Punishmented_Employee',
                'ar'=>'الموظفين_المعاقبين'
            ],
            [

                'en'=>'Punishmented_Employee_Processes',
                'ar'=>'عمليات_الموظفين_المعاقبين'
            ],
            [

                'en'=>'Employee_Punishments',
                'ar'=>'عقوبات_الموظف'
            ],
            [

                'en'=> 'Attendance_Register',
                'ar'=> 'تسجيل_الدوام'
            ],
            [

                'en'=> 'Leaves',
                'ar'=> 'الإجازات'
            ],
            [

                'en'=> 'View_Leave_Requests',
                'ar'=> 'عرض_طلبات_الإجازة'
            ],
            [

                'en'=>'Leave_Request',
                'ar'=>'تقديم_طلب_إجازة'
            ],
            [

                'en'=>'Awards',
                'ar'=>'الجوائز'
            ],

            [

                'en'=>'Add_Awards',
                'ar'=>'إضافة_جائزة'
            ],

            [

                'en'=>'Employee_Awards',
                'ar'=>'جوائز_الموظف'
            ],
            [

                'en'=>'Requests',
                'ar'=>'الطلبات'
            ],
            [

                'en'=>'Employees_Requests_Show',
                'ar'=>'عرض_طلبات_الموظفين'
            ],
            [

                'en'=>'Send_Requests',
                'ar'=>'ارسال_طلبات'
            ],
            [

                'en'=>'Tasks',
                'ar'=>'المهام'
            ],

            [

                'en'=>'Employees_Tasks_Show',
                'ar'=>'عرض_مهام_الموظفين'
            ],
            [

                'en'=>'Employee_Tasks',
                'ar'=>'مهام_الموظف'
            ],
            [

                'en'=>'Show_Attendances_Calendar',
                'ar'=>'صلاحية_عرض_تقويم_الدوام'
            ],

            [

                'en'=>'Show_Tasks_Calendar',
                'ar'=>'صلاحية_عرض_تقويم_المهام'
            ],
            [

                'en'=>'Show_Events',
                'ar'=>'صلاحية_عرض_تقويم_المناسبات'
            ],
            [

                'en'=>'Editing_To_Same_Location',
                'ar'=>'تعديل_لنفس_المركز'
            ],
            [

                'en'=>'Editing_To_Same_Department',
                'ar'=>'تعديل_لنفس_القسم'
            ],

            [

                'en'=>'Just_Employees_Processes',
                'ar'=>'عمليات_على_الموظفين_فقط'
            ],

            ];


        foreach ($permissions as $permission) {

            Permission::create([
            'name' => $permission ,
]);
        }

    }
}
