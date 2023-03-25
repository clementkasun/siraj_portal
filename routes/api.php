<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactResponseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\RollController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ApplicantLanguagesController;
use App\Http\Controllers\ApplicantPreviousEmployeementController;
use App\Http\Controllers\ApplicationStaffResponseController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OnlineApplicantController;
use App\Http\Controllers\PhoneNumberController;
use App\Http\Controllers\PhoneNumberResponseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
  */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

//role api's
Route::get('/rolls/levelId/{id}', [LevelController::class, 'rolesByLevel'])->name('rolesByLevel');
Route::get('/rolls/id/{id}', [RollController::class, 'getRoleById'])->name('getRoleById');
Route::post('/save_roles', [RollController::class, 'create'])->name('create_system_Rolls');

//user api's
Route::post('/save_user', [UserController::class, 'create']);
Route::post('/update_user/id/{user_id}', [UserController::class, 'update']);
Route::post('/is_nic_or_email_exist', [UserController::class, 'is_nic_or_email_exist']);

//contacts api's
Route::post('/save_contact', [ContactController::class, 'store']);
Route::middleware(['auth:sanctum'])->get('/get_contacts', [ContactController::class, 'show']);

//contacts response api's
Route::middleware(['auth:sanctum'])->post('/save_contact_response', [ContactResponseController::class, 'store']);
Route::middleware(['auth:sanctum'])->get('/get_contact_responses', [ContactResponseController::class, 'show']);
Route::middleware(['auth:sanctum'])->post('/update_contact_response/id/{contact_id}', [ContactResponseController::class, 'update']);
Route::middleware(['auth:sanctum'])->get('/get_contact_response/id/{contact_id}', [ContactResponseController::class, 'getContactResponse']);
Route::middleware(['auth:sanctum'])->delete('/delete_contact_response/id/{contact_id}', [ContactResponseController::class, 'destroy']);

//vacancy api's
Route::middleware(['auth:sanctum'])->post('/save_vacancy', [VacancyController::class, 'store']);
Route::middleware(['auth:sanctum'])->post('/update_vacancy/id/{vacancy_id}', [VacancyController::class, 'update']);
Route::middleware(['auth:sanctum'])->delete('/delete_vacancy/id/{vacancy_id}', [VacancyController::class, 'destroy']);
Route::get('/get_vacancies', [VacancyController::class, 'show']);
Route::get('/get_vacancy/id/{vacancy_id}', [VacancyController::class, 'getVacancy']);
Route::post('/get_paginated_vacancy', [VacancyController::class, 'getPaginatedVacancy']);

//applicant api's
Route::middleware(['auth:sanctum'])->post('/save_applicant', [ApplicantController::class, 'store']);
Route::middleware(['auth:sanctum'])->post('/update_applicant/id/{applicant_id}', [ApplicantController::class, 'update']);
Route::middleware(['auth:sanctum'])->get('/get_applicants', [ApplicantController::class, 'show']);
Route::middleware(['auth:sanctum'])->get('/get_applicant/id/{applicant_id}', [ApplicantController::class, 'getApplicantDetails']);
Route::middleware(['auth:sanctum'])->delete('/delete_applicant/id/{applicant_id}', [ApplicantController::class, 'destroy']);

//educational qualification api's 
// Route::middleware(['auth:sanctum'])->post('/save_educational_qualification', [ApplicantEducationalQualificationController::class, 'store']);
// Route::middleware(['auth:sanctum'])->post('/update_educational_qualification/id/{id}', [ApplicantEducationalQualificationController::class, 'update']);
// Route::middleware(['auth:sanctum'])->get('/get_educational_qualification/id/{id}', [ApplicantEducationalQualificationController::class, 'getEducationalQualification']);
// Route::middleware(['auth:sanctum'])->get('/get_educational_qualifications/id/{applicant_id}', [ApplicantEducationalQualificationController::class, 'show']);
// Route::middleware(['auth:sanctum'])->delete('/delete_educational_qualification/id/{applicant_id}', [ApplicantEducationalQualificationController::class, 'destroy']);

//previous employeement api's
Route::middleware(['auth:sanctum'])->post('/save_previous_employeement', [ApplicantPreviousEmployeementController::class, 'store']);
Route::middleware(['auth:sanctum'])->post('/update_previous_employeement/id/{id}', [ApplicantPreviousEmployeementController::class, 'update']);
Route::middleware(['auth:sanctum'])->get('/get_previous_experience/id/{id}', [ApplicantPreviousEmployeementController::class, 'getPreviousEmployeement']);
Route::middleware(['auth:sanctum'])->get('/get_previous_employeements/id/{applicant_id}', [ApplicantPreviousEmployeementController::class, 'show']);
Route::middleware(['auth:sanctum'])->delete('/delete_previous_employeement/id/{applicant_id}', [ApplicantPreviousEmployeementController::class, 'destroy']);

//applicant language api's
Route::middleware(['auth:sanctum'])->post('/save_applicant_language', [ApplicantLanguagesController::class, 'store']);
Route::middleware(['auth:sanctum'])->post('/update_applicant_language/id/{id}', [ApplicantLanguagesController::class, 'update']);
Route::middleware(['auth:sanctum'])->get('/get_applicant_language/id/{id}', [ApplicantLanguagesController::class, 'getApplicantLanguage']);
Route::middleware(['auth:sanctum'])->get('/get_applicant_languages/id/{applicant_id}', [ApplicantLanguagesController::class, 'show']);
Route::middleware(['auth:sanctum'])->delete('/delete_application_language/id/{id}', [ApplicantLanguagesController::class, 'destroy']);

//application staff response api's
Route::middleware(['auth:sanctum'])->post('/save_application_staff_response', [ApplicationStaffResponseController::class, 'store']);
Route::middleware(['auth:sanctum'])->post('/update_application_staff_response/id/{id}', [ApplicationStaffResponseController::class, 'update']);
Route::middleware(['auth:sanctum'])->get('/get_application_staff_response/id/{id}', [ApplicationStaffResponseController::class, 'getApplicationStaffResponse']);
Route::middleware(['auth:sanctum'])->get('/get_application_staff_responses/id/{applicant_id}', [ApplicationStaffResponseController::class, 'show']);
Route::middleware(['auth:sanctum'])->delete('/delete_application_staff_response/id/{applicant_id}', [ApplicationStaffResponseController::class, 'destroy']);

//commission response api's
Route::middleware(['auth:sanctum'])->post('/save_comission', [CommissionController::class, 'store']);
Route::middleware(['auth:sanctum'])->post('/update_comission/id/{id}', [CommissionController::class, 'update']);
Route::middleware(['auth:sanctum'])->get('/get_comission/id/{id}', [CommissionController::class, 'getComission']);
Route::middleware(['auth:sanctum'])->get('/get_comissions/id/{applicant_id}', [CommissionController::class, 'show']);
Route::middleware(['auth:sanctum'])->delete('/delete_comission/id/{applicant_id}', [CommissionController::class, 'destroy']);

//dashboard api's
Route::get('/get_counts', [DashboardController::class, 'getCounts']);

//online applicant api's
Route::post('/save_online_applicant', [OnlineApplicantController::class, 'store']);

//online applicant response api's
Route::middleware(['auth:sanctum'])->post('/save_online_applicant_resp', [OnlineApplicantResponseController::class, 'store']);

//blog post api's
Route::middleware(['auth:sanctum'])->post('/save_blog_post', [BlogPostController::class, 'store']);
Route::middleware(['auth:sanctum'])->post('/update_blog_post/id/{blog_post_id}', [BlogPostController::class, 'update']);
Route::get('/get_blog_posts', [BlogPostController::class, 'show']);
Route::post('/get_paginated_blog_posts', [BlogPostController::class, 'getPaginatedBlogPosts']);
Route::get('/get_blog_post/id/{blog_post_id}', [BlogPostController::class, 'getBlogPost']);
Route::middleware(['auth:sanctum'])->delete('/delete_blog_post/id/{blog_post_id}', [BlogPostController::class, 'destroy']);

//phone number api's
Route::middleware(['auth:sanctum'])->post('/save_phone_number', [PhoneNumberController::class, 'store']);
Route::middleware(['auth:sanctum'])->post('/update_phone_number/id/{phone_number_id}', [PhoneNumberController::class, 'update']);
Route::middleware(['auth:sanctum'])->get('/get_phone_numbers', [PhoneNumberController::class, 'show']);
Route::middleware(['auth:sanctum'])->get('/get_phone_number/id/{phone_number_id}', [PhoneNumberController::class, 'getPhoneNumberDetails']);
Route::middleware(['auth:sanctum'])->delete('/delete_phone_number/id/{phone_number_id}', [PhoneNumberController::class, 'destroy']);

//phone number respone api's
Route::middleware(['auth:sanctum'])->post('/save_phone_number_response', [PhoneNumberResponseController::class, 'store']);
Route::middleware(['auth:sanctum'])->get('/get_phone_number_responses/id/{phone_number_id}', [PhoneNumberResponseController::class, 'show']);
