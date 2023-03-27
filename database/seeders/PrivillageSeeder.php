<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PrivillageSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $privileges = [
            ['id' => 1, 'name' => 'User'],
            ['id' => 2, 'name' => 'OnlineApplicant'],
            ['id' => 3, 'name' => 'ApplicationStaffResponse'],
            ['id' => 4, 'name' => 'OfflineApplicant'],
            ['id' => 5, 'name' => 'PhoneNumber'],
            ['id' => 6, 'name' => 'PhoneNumberResponse'],
            ['id' => 7, 'name' => 'ContactUs'],
            ['id' => 8, 'name' => 'ContactUsResponse'],
            ['id' => 9, 'name' => 'BlogPost'],
            ['id' => 10, 'name' => 'Vacancy'],
            ['id' => 11, 'name' => 'Commission'],
            ['id' => 12, 'name' => 'PreviousEmployeement'],
            ['id' => 13, 'name' => 'ApplicantLanguage'],
            ['id' => 14, 'name' => 'OnlineApplicantResponse'],
            ['id' => 15, 'name' => 'ViewLogRoute']
        ];
        \DB::table('privillages')->insert($privileges);
    }
}
