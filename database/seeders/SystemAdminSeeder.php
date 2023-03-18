<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use function PHPSTORM_META\type;

class SystemAdminSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('12345678');
        $admin_user = array('first_name' => 'Admin',  'email' => 'cybercore@gmail.com', 'password' => $password, 'role_id' => 1);

        $user = user::create($admin_user);
        $role_privillage = [
            ['privillage_id' => 1, 'role_id' => $user->role_id, 'is_read' => 1, 'is_create' => 1, 'is_update' => 1, 'is_delete' => 1],
            ['privillage_id' => 2, 'role_id' => $user->role_id, 'is_read' => 1, 'is_create' => 1, 'is_update' => 1, 'is_delete' => 1],
            ['privillage_id' => 3, 'role_id' => $user->role_id, 'is_read' => 1, 'is_create' => 1, 'is_update' => 1, 'is_delete' => 1],
            ['privillage_id' => 4, 'role_id' => $user->role_id, 'is_read' => 1, 'is_create' => 1, 'is_update' => 1, 'is_delete' => 1],
            ['privillage_id' => 5, 'role_id' => $user->role_id, 'is_read' => 1, 'is_create' => 1, 'is_update' => 1, 'is_delete' => 1],
            ['privillage_id' => 6, 'role_id' => $user->role_id, 'is_read' => 1, 'is_create' => 1, 'is_update' => 1, 'is_delete' => 1],
            ['privillage_id' => 7, 'role_id' => $user->role_id, 'is_read' => 1, 'is_create' => 1, 'is_update' => 1, 'is_delete' => 1],
            ['privillage_id' => 8, 'role_id' => $user->role_id, 'is_read' => 1, 'is_create' => 1, 'is_update' => 1, 'is_delete' => 1],
            ['privillage_id' => 9, 'role_id' => $user->role_id, 'is_read' => 1, 'is_create' => 1, 'is_update' => 1, 'is_delete' => 1],
            ['privillage_id' => 10, 'role_id' => $user->role_id, 'is_read' => 1, 'is_create' => 1, 'is_update' => 1, 'is_delete' => 1],
            ['privillage_id' => 11, 'role_id' => $user->role_id, 'is_read' => 1, 'is_create' => 1, 'is_update' => 1, 'is_delete' => 1],
        ];

        \DB::table('role_privillages')->insert($role_privillage);
    }
}
