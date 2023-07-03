<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $user = User::create([
            'name' => 'laila',
            'email' => 'lailamsallaty607@gmail.com',
            'password' => bcrypt('12345678'),
            'roles_name' => [['ar' => 'المدير', 'en' => 'Admin']],
            'Status' =>  1,
            ]);

            $role = Role::create(['name' => ['ar' => 'المدير', 'en' => 'Admin']]);

            $permissions = Permission::pluck('id','id')->all();

            $role->syncPermissions($permissions);

            $user->assignRole([$role->id]);
    }
}
