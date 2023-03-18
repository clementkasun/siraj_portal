<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class PrivillageSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $privileges = [
            ['id' => 1, 'name' => 'user'],
            ['id' => 2, 'name' => 'role'],
            ['id' => 3, 'name' => 'level'],
            ['id' => 4, 'name' => 'privillage'],
            ['id' => 5, 'name' => 'contact'],
            ['id' => 6, 'name' => 'candidate'],
            ['id' => 7, 'name' => 'contact_response'],
            ['id' => 8, 'name' => 'candidate_response'],
            ['id' => 9, 'name' => 'vacancy'],
            ['id' => 10, 'name' => 'applicant'],
            ['id' => 11, 'name' => 'application_staff_response'],
        ];
        \DB::table('privillages')->insert($privileges);
    }

}
