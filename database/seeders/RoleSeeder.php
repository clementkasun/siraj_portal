<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolls = [
            ['name' => 'Admin', 'level_id' => 1],
            ['name' => 'Manager', 'level_id' => 2],
            ['name' => 'Staff Member', 'level_id' => 3],
        ];
        \DB::table('roles')->insert($rolls);
    }
}
