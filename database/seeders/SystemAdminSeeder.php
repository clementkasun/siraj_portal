<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SystemAdminSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('cyberadmin@#1234');
        user::create(['first_name' => 'Admin', 'last_name' => 'Admin', 'preffered_name' => 'Admin', 'email' => 'cybercore@gmail.com', 'password' => $password, 'role_id' => 1, 'status' => 'Active']);

        $role_privillage = [

            //privillages for the admin
            [
                //user privillage done
                'privillage_id' => 1,
                'role_id' => 1,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1
            ],
            [
                //Online Applcant Privillage done
                'privillage_id' => 2,
                'role_id' => 1,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Application Staff Response Privillage done
                'privillage_id' => 3,
                'role_id' => 1,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Offline Applicant Privillage done 
                'privillage_id' => 4,
                'role_id' => 1,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 0
            ],
            [
                //Phone Number Privillage done
                'privillage_id' => 5,
                'role_id' => 1,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Phone Number Response Privillage done
                'privillage_id' => 6,
                'role_id' => 1,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 0
            ],
            [
                //Contact Us Privillage done
                'privillage_id' => 7,
                'role_id' => 1,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Contact Us Response Privillage done
                'privillage_id' => 8,
                'role_id' => 1,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 0
            ],
            [
                //blog post Privillage done
                'privillage_id' => 9,
                'role_id' => 1,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1
            ],
            [
                //Vacancy Privillage done
                'privillage_id' => 10,
                'role_id' => 1,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1
            ],
            [
                //Commission Privillage done
                'privillage_id' => 11,
                'role_id' => 1,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 0
            ],
            [
                //Previous Employeement done
                'privillage_id' => 12,
                'role_id' => 1,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1
            ],
            [
                //Apllicant Language Privillage done
                'privillage_id' => 13,
                'role_id' => 1,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1
            ],
            [
                //Online Applicant Response Privillage done
                'privillage_id' => 14,
                'role_id' => 1,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
               //View logs Privillage done
                'privillage_id' => 15,
                'role_id' => 1,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],

            //privillages for the owner
            [
                //user privillage done
                'privillage_id' => 1,
                'role_id' => 2,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 0
            ],
            [
                //Online Applcant Privillage done
                'privillage_id' => 2,
                'role_id' => 2,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Application Staff Response Privillage done
                'privillage_id' => 3,
                'role_id' => 2,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Offline Applicant Privillage done 
                'privillage_id' => 4,
                'role_id' => 2,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 0
            ],
            [
                //Phone Number Privillage done
                'privillage_id' => 5,
                'role_id' => 2,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Phone Number Response Privillage done
                'privillage_id' => 6,
                'role_id' => 2,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Contact Us Privillage done
                'privillage_id' => 7,
                'role_id' => 2,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Contact Us Response Privillage done
                'privillage_id' => 8,
                'role_id' => 2,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //blog post Privillage done
                'privillage_id' => 9,
                'role_id' => 2,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1
            ],
            [
                //Vacancy Privillage done
                'privillage_id' => 10,
                'role_id' => 2,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1
            ],
            [
                //Commission Privillage done
                'privillage_id' => 11,
                'role_id' => 2,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Previous Employeement Privillage done
                'privillage_id' => 12,
                'role_id' => 2,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1
            ],
            [
                //Apllicant Language Privillage done
                'privillage_id' => 13,
                'role_id' => 2,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1
            ],
            [
                //Online Applicant Response Privillage done
                'privillage_id' => 14,
                'role_id' => 2,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //View logs Privillage done
                'privillage_id' => 15,
                'role_id' => 2,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],

            //privillages for the IT Officer
            [
                //user privillage done
                'privillage_id' => 1,
                'role_id' => 3,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 0
            ],
            [
                //Online Applcant Privillage done
                'privillage_id' => 2,
                'role_id' => 3,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Application Staff Response Privillage done
                'privillage_id' => 3,
                'role_id' => 3,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Offline Applicant Privillage done 
                'privillage_id' => 4,
                'role_id' => 3,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 0
            ],
            [
                //Phone Number Privillage done
                'privillage_id' => 5,
                'role_id' => 3,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Phone Number Response Privillage done
                'privillage_id' => 6,
                'role_id' => 3,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Contact Us Privillage done
                'privillage_id' => 7,
                'role_id' => 3,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Contact Us Response Privillage done
                'privillage_id' => 8,
                'role_id' => 3,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //blog post Privillage done
                'privillage_id' => 9,
                'role_id' => 3,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1
            ],
            [
                //Vacancy Privillage done
                'privillage_id' => 10,
                'role_id' => 3,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1
            ],
            [
                //Commission Privillage done
                'privillage_id' => 11,
                'role_id' => 3,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Previous Employeement done
                'privillage_id' => 12,
                'role_id' => 3,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1
            ],
            [
                //Apllicant Language Privillage done
                'privillage_id' => 13,
                'role_id' => 3,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 1
            ],
            [
                //Online Applicant Response Privillage done
                'privillage_id' => 14,
                'role_id' => 3,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //View logs Privillage done
                'privillage_id' => 15,
                'role_id' => 3,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],

            //privillages for the Manager
            [
                //user privillage done
                'privillage_id' => 1,
                'role_id' => 4,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Online Applcant Privillage done
                'privillage_id' => 2,
                'role_id' => 4,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Application Staff Response Privillage done
                'privillage_id' => 3,
                'role_id' => 4,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Offline Applicant Privillage done 
                'privillage_id' => 4,
                'role_id' => 4,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 0
            ],
            [
                //Phone Number Privillage done
                'privillage_id' => 5,
                'role_id' => 4,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Phone Number Response Privillage done
                'privillage_id' => 6,
                'role_id' => 4,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Contact Us Privillage done
                'privillage_id' => 7,
                'role_id' => 4,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Contact Us Response Privillage done
                'privillage_id' => 8,
                'role_id' => 4,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [ //Blog Post Privillage done
                'privillage_id' => 9,
                'role_id' => 4,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [ //Vacancy Privillage done
                'privillage_id' => 10,
                'role_id' => 4,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Commission Privillage done
                'privillage_id' => 11,
                'role_id' => 4,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Previous Employeement done
                'privillage_id' => 12,
                'role_id' => 4,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Apllicant Language Privillage done
                'privillage_id' => 13,
                'role_id' => 4,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Online Applicant Response Privillage done
                'privillage_id' => 14,
                'role_id' => 4,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //View logs Privillage done
                'privillage_id' => 15,
                'role_id' => 4,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],

            //privillages for the supervisor
            [
                //user privillage done
                'privillage_id' => 1,
                'role_id' => 5,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Online Applcant Privillage done
                'privillage_id' => 2,
                'role_id' => 5,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Application Staff Response Privillage done
                'privillage_id' => 3,
                'role_id' => 5,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Offline Applicant Privillage done 
                'privillage_id' => 4,
                'role_id' => 5,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 1,
                'is_delete' => 0
            ],
            [
                //Phone Number Privillage done
                'privillage_id' => 5,
                'role_id' => 5,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Phone Number Response Privillage done
                'privillage_id' => 6,
                'role_id' => 5,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Contact Us Privillage done
                'privillage_id' => 7,
                'role_id' => 5,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Contact Us Response Privillage done
                'privillage_id' => 8,
                'role_id' => 5,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Blog Post Privillage done
                'privillage_id' => 9,
                'role_id' => 5,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Vacancy Privillage done
                'privillage_id' => 10,
                'role_id' => 5,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Commission Privillage done
                'privillage_id' => 11,
                'role_id' => 5,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Previous Employeement done
                'privillage_id' => 12,
                'role_id' => 5,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Apllicant Language Privillage done
                'privillage_id' => 13,
                'role_id' => 5,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Online Applicant Response Privillage done
                'privillage_id' => 14,
                'role_id' => 5,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //View logs Privillage done
                'privillage_id' => 15,
                'role_id' => 5,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],

            //privillages for the call center
            [
                //user privillage done
                'privillage_id' => 1,
                'role_id' => 6,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Online Applcant Privillage done
                'privillage_id' => 2,
                'role_id' => 6,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Application Staff Response Privillage done
                'privillage_id' => 3,
                'role_id' => 6,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Offline Applicant Privillage done
                'privillage_id' => 4,
                'role_id' => 6,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Phone Number Privillage done
                'privillage_id' => 5,
                'role_id' => 6,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Phone Number Response Privillage done
                'privillage_id' => 6,
                'role_id' => 6,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Contact Us Privillage done
                'privillage_id' => 7,
                'role_id' => 6,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Contact Us Response Privillage done
                'privillage_id' => 8,
                'role_id' => 6,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Blog Post Privillage done
                'privillage_id' => 9,
                'role_id' => 6,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Vacancy Privillage done
                'privillage_id' => 10,
                'role_id' => 6,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Commission Privillage done
                'privillage_id' => 11,
                'role_id' => 6,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Previous Employeement done
                'privillage_id' => 12,
                'role_id' => 6,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Apllicant Language Privillage done
                'privillage_id' => 13,
                'role_id' => 6,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Online Applicant Response Privillage done
                'privillage_id' => 14,
                'role_id' => 6,
                'is_read' => 1,
                'is_create' => 1,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //View logs Privillage done
                'privillage_id' => 15,
                'role_id' => 6,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],

            //privillages for the receptionist
            [
                //user privillage done
                'privillage_id' => 1,
                'role_id' => 7,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Online Applcant Privillage done
                'privillage_id' => 2,
                'role_id' => 7,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Application Staff Response Privillage done
                'privillage_id' => 3,
                'role_id' => 7,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Offline Applicant Privillage done
                'privillage_id' => 4,
                'role_id' => 7,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Phone Number Privillage done
                'privillage_id' => 5,
                'role_id' => 7,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Phone Number Response Privillage done
                'privillage_id' => 6,
                'role_id' => 7,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Contact Us Privillage done
                'privillage_id' => 7,
                'role_id' => 7,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Contact Us Response Privillage done
                'privillage_id' => 8,
                'role_id' => 7,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Blog Post Privillage done
                'privillage_id' => 9,
                'role_id' => 7,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Vacancy Privillage done
                'privillage_id' => 10,
                'role_id' => 7,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Commission Privillage done
                'privillage_id' => 11,
                'role_id' => 7,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Previous Employeement Privillage done
                'privillage_id' => 12,
                'role_id' => 7,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Apllicant Language Privillage done
                'privillage_id' => 13,
                'role_id' => 7,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //Online Applicant Response Privillage done
                'privillage_id' => 14,
                'role_id' => 7,
                'is_read' => 1,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
            [
                //View logs Privillage done
                'privillage_id' => 15,
                'role_id' => 7,
                'is_read' => 0,
                'is_create' => 0,
                'is_update' => 0,
                'is_delete' => 0
            ],
        ];

        \DB::table('role_privillages')->insert($role_privillage);
    }
}
