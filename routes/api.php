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
use App\Http\Controllers\OnlineApplicantResponseController;
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
Route::middleware('routeLog')->get('/rolls/levelId/{id}', [LevelController::class, 'rolesByLevel'])->name('rolesByLevel');
Route::middleware('routeLog')->get('/rolls/id/{id}', [RollController::class, 'getRoleById'])->name('getRoleById');
Route::middleware('routeLog')->get('/rolls', [RollController::class, 'getRoles']);
Route::middleware('routeLog')->post('/save_roles', [RollController::class, 'create'])->name('create_system_Rolls');
Route::middleware('routeLog')->delete('/delete_user/id/{id}', [UserController::class, 'delete']);

//user api's
Route::middleware(['auth:sanctum', 'routeLog'])->post('/save_user', [UserController::class, 'create']);
Route::middleware(['auth:sanctum', 'routeLog'])->post('/update_user/id/{user_id}', [UserController::class, 'update']);
Route::middleware('routeLog')->post('/is_nic_or_email_exist', [UserController::class, 'is_nic_or_email_exist']);

//contacts api's
Route::middleware('auth:sanctum', 'routeLog')->post('/save_contact', [ContactController::class, 'store']);
Route::middleware('auth:sanctum', 'routeLog')->post('/change_contact_status/id/{contact_id}', [ContactController::class, 'changeContactStatus']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_contacts', [ContactController::class, 'show']);

//contacts response api's
Route::middleware(['auth:sanctum', 'routeLog'])->post('/save_contact_response', [ContactResponseController::class, 'store']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_contact_responses', [ContactResponseController::class, 'show']);
Route::middleware(['auth:sanctum', 'routeLog'])->post('/update_contact_response/id/{contact_id}', [ContactResponseController::class, 'update']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_contact_response/id/{contact_id}', [ContactResponseController::class, 'getContactResponse']);
Route::middleware(['auth:sanctum', 'routeLog'])->delete('/delete_contact_response/id/{contact_id}', [ContactResponseController::class, 'destroy']);

//vacancy api's
Route::middleware(['auth:sanctum', 'routeLog'])->post('/save_vacancy', [VacancyController::class, 'store']);
Route::middleware(['auth:sanctum', 'routeLog'])->post('/update_vacancy/id/{vacancy_id}', [VacancyController::class, 'update']);
Route::middleware(['auth:sanctum', 'routeLog'])->delete('/delete_vacancy/id/{vacancy_id}', [VacancyController::class, 'destroy']);
Route::middleware('routeLog')->get('/get_vacancies', [VacancyController::class, 'show']);
Route::middleware('routeLog')->get('/get_vacancy/id/{vacancy_id}', [VacancyController::class, 'getVacancy']);
Route::middleware('routeLog')->post('/get_paginated_vacancy', [VacancyController::class, 'getPaginatedVacancy']);

//applicant api's
Route::middleware(['auth:sanctum', 'routeLog'])->post('/save_applicant', [ApplicantController::class, 'store']);
Route::middleware(['auth:sanctum', 'routeLog'])->post('/update_applicant/id/{applicant_id}', [ApplicantController::class, 'update']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_applicants', [ApplicantController::class, 'show']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_applicant/id/{applicant_id}', [ApplicantController::class, 'getApplicantDetails']);
Route::middleware(['auth:sanctum', 'routeLog'])->delete('/delete_applicant/id/{applicant_id}', [ApplicantController::class, 'destroy']);

//educational qualification api's 
// Route::middleware(['auth:sanctum'])->post('/save_educational_qualification', [ApplicantEducationalQualificationController::class, 'store']);
// Route::middleware(['auth:sanctum'])->post('/update_educational_qualification/id/{id}', [ApplicantEducationalQualificationController::class, 'update']);
// Route::middleware(['auth:sanctum'])->get('/get_educational_qualification/id/{id}', [ApplicantEducationalQualificationController::class, 'getEducationalQualification']);
// Route::middleware(['auth:sanctum'])->get('/get_educational_qualifications/id/{applicant_id}', [ApplicantEducationalQualificationController::class, 'show']);
// Route::middleware(['auth:sanctum'])->delete('/delete_educational_qualification/id/{applicant_id}', [ApplicantEducationalQualificationController::class, 'destroy']);

//previous employeement api's
Route::middleware(['auth:sanctum', 'routeLog'])->post('/save_previous_employeement', [ApplicantPreviousEmployeementController::class, 'store']);
Route::middleware(['auth:sanctum', 'routeLog'])->post('/update_previous_employeement/id/{id}', [ApplicantPreviousEmployeementController::class, 'update']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_previous_experience/id/{id}', [ApplicantPreviousEmployeementController::class, 'getPreviousEmployeement']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_previous_employeements/id/{applicant_id}', [ApplicantPreviousEmployeementController::class, 'show']);
Route::middleware(['auth:sanctum', 'routeLog'])->delete('/delete_previous_employeement/id/{applicant_id}', [ApplicantPreviousEmployeementController::class, 'destroy']);

//applicant language api's
Route::middleware(['auth:sanctum', 'routeLog'])->post('/save_applicant_language', [ApplicantLanguagesController::class, 'store']);
Route::middleware(['auth:sanctum', 'routeLog'])->post('/update_applicant_language/id/{id}', [ApplicantLanguagesController::class, 'update']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_applicant_language/id/{id}', [ApplicantLanguagesController::class, 'getApplicantLanguage']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_applicant_languages/id/{applicant_id}', [ApplicantLanguagesController::class, 'show']);
Route::middleware(['auth:sanctum', 'routeLog'])->delete('/delete_application_language/id/{id}', [ApplicantLanguagesController::class, 'destroy']);

//application staff response api's
Route::middleware(['auth:sanctum', 'routeLog'])->post('/save_application_staff_response', [ApplicationStaffResponseController::class, 'store']);
Route::middleware(['auth:sanctum', 'routeLog'])->post('/update_application_staff_response/id/{id}', [ApplicationStaffResponseController::class, 'update']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_application_staff_response/id/{id}', [ApplicationStaffResponseController::class, 'getApplicationStaffResponse']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_application_staff_responses/id/{applicant_id}', [ApplicationStaffResponseController::class, 'show']);
Route::middleware(['auth:sanctum', 'routeLog'])->delete('/delete_application_staff_response/id/{applicant_id}', [ApplicationStaffResponseController::class, 'destroy']);

//commission response api's
Route::middleware(['auth:sanctum', 'routeLog'])->post('/save_comission', [CommissionController::class, 'store']);
Route::middleware(['auth:sanctum', 'routeLog'])->post('/update_comission/id/{id}', [CommissionController::class, 'update']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_comission/id/{id}', [CommissionController::class, 'getComission']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_comissions/id/{applicant_id}', [CommissionController::class, 'show']);
Route::middleware(['auth:sanctum', 'routeLog'])->delete('/delete_comission/id/{applicant_id}', [CommissionController::class, 'destroy']);

//dashboard api's
Route::middleware('routeLog')->get('/get_counts', [DashboardController::class, 'getCounts']);

//online applicant api's
Route::middleware('routeLog')->post('/save_online_applicant', [OnlineApplicantController::class, 'store']);
Route::middleware('auth:sanctum','routeLog')->post('/change_online_app_status/id/{online_applicant_id}', [OnlineApplicantController::class, 'changeOnlineAppStatus']);

//online applicant response api's
Route::middleware(['auth:sanctum', 'routeLog'])->post('/save_online_applicant_resp', [OnlineApplicantResponseController::class, 'store']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_online_applicant_responses', [OnlineApplicantResponseController::class, 'show']);

//blog post api's
Route::middleware(['auth:sanctum', 'routeLog'])->post('/save_blog_post', [BlogPostController::class, 'store']);
Route::middleware(['auth:sanctum', 'routeLog'])->post('/update_blog_post/id/{blog_post_id}', [BlogPostController::class, 'update']);
Route::middleware('routeLog')->get('/get_blog_posts', [BlogPostController::class, 'show']);
Route::middleware('routeLog')->post('/get_paginated_blog_posts', [BlogPostController::class, 'getPaginatedBlogPosts']);
Route::middleware('routeLog')->get('/get_blog_post/id/{blog_post_id}', [BlogPostController::class, 'getBlogPost']);
Route::middleware(['auth:sanctum', 'routeLog'])->delete('/delete_blog_post/id/{blog_post_id}', [BlogPostController::class, 'destroy']);

//phone number api's
Route::middleware(['auth:sanctum', 'routeLog'])->post('/save_phone_number', [PhoneNumberController::class, 'store']);
Route::middleware(['auth:sanctum', 'routeLog'])->post('/update_phone_number/id/{phone_number_id}', [PhoneNumberController::class, 'update']);
Route::middleware(['auth:sanctum', 'routeLog'])->post('/change_phone_num_status/id/{phone_number_id}', [PhoneNumberController::class, 'changePhoneNumberStatus']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_phone_numbers', [PhoneNumberController::class, 'show']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_phone_number/id/{phone_number_id}', [PhoneNumberController::class, 'getPhoneNumberDetails']);
Route::middleware(['auth:sanctum', 'routeLog'])->delete('/delete_phone_number/id/{phone_number_id}', [PhoneNumberController::class, 'destroy']);

//phone number respone api's
Route::middleware(['auth:sanctum', 'routeLog'])->post('/save_phone_number_response', [PhoneNumberResponseController::class, 'store']);
Route::middleware(['auth:sanctum', 'routeLog'])->get('/get_phone_number_responses/id/{phone_number_id}', [PhoneNumberResponseController::class, 'show']);
