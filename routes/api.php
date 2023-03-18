<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CandidateResponseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactResponseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\RollController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ApplicantEducationalQualificationController;
use App\Http\Controllers\ApplicantLanguagesController;
use App\Http\Controllers\ApplicantPreviousEmployeementController;
use App\Http\Controllers\ApplicationStaffResponseController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\DashboardController;
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

// Route::middleware(['auth'])->group(function () {
//user api's
Route::get('/rolls/levelId/{id}', [LevelController::class, 'rolesByLevel'])->name('rolesByLevel');
Route::post('/save_roles', [RollController::class, 'create'])->name('create_system_Rolls');
Route::post('/save_user', [UserController::class, 'create']);
Route::post('/update_user/id/{user_id}', [UserController::class, 'update']);
Route::post('/is_nic_or_email_exist', [UserController::class, 'is_nic_or_email_exist']);

//contacts api's
Route::post('/save_contact', [ContactController::class, 'store']);
Route::get('/get_contacts', [ContactController::class, 'show']);

//contacts response api's
Route::post('/save_contact_reponse', [ContactResponseController::class, 'store']);
Route::get('/get_contact_reponses', [ContactResponseController::class, 'show']);
Route::post('/update_contact_response/id/{contact_id}', [ContactResponseController::class, 'update']);
Route::get('/get_contact_response/id/{contact_id}', [ContactResponseController::class, 'getContact']);
Route::delete('/delete_contact_response/id/{contact_id}', [ContactResponseController::class, 'destroy']);

//candidate api's
Route::post('/save_candidate', [CandidateController::class, 'store']);
Route::get('/get_candidates', [CandidateController::class, 'show']);

//candidate response api's
Route::post('/save_candidate_response', [CandidateResponseController::class, 'store']);
Route::post('/update_candidate_response/id/{candidate_id}', [CandidateResponseController::class, 'update']);
Route::get('/get_candidate_responses', [CandidateResponseController::class, 'show']);
Route::get('/get_candidate_response/id/{candidate_id}', [CandidateResponseController::class, 'getCandidate']);
Route::delete('/delete_candidate_response/id/{candidate_id}', [CandidateResponseController::class, 'destroy']);

//vacancy api's
Route::post('/save_vacancy', [VacancyController::class, 'store']);
Route::post('/update_vacancy/id/{vacancy_id}', [VacancyController::class, 'update']);
Route::delete('/delete_vacancy/id/{vacancy_id}', [VacancyController::class, 'destroy']);
Route::get('/get_vacancies', [VacancyController::class, 'show']);
Route::get('/get_vacancy/id/{vacancy_id}', [VacancyController::class, 'getVacancy']);
Route::post('/get_paginated_vacancy', [VacancyController::class, 'getPaginatedVacancy']);

//applicant api's
Route::post('/save_applicant', [ApplicantController::class, 'store']);
Route::post('/update_applicant/id/{applicant_id}', [ApplicantController::class, 'update']);
Route::get('/get_applicants', [ApplicantController::class, 'show']);
Route::get('/get_applicant/id/{applicant_id}', [ApplicantController::class, 'getApplicantDetails']);
Route::delete('/delete_applicant/id/{applicant_id}', [ApplicantController::class, 'destroy']);

//educational qualification api's
Route::post('/save_educational_qualification', [ApplicantEducationalQualificationController::class, 'store']);
Route::post('/update_educational_qualification/id/{id}', [ApplicantEducationalQualificationController::class, 'update']);
Route::get('/get_educational_qualification/id/{id}', [ApplicantEducationalQualificationController::class, 'getEducationalQualification']);
Route::get('/get_educational_qualifications/id/{applicant_id}', [ApplicantEducationalQualificationController::class, 'show']);
Route::delete('/delete_educational_qualification/id/{applicant_id}', [ApplicantEducationalQualificationController::class, 'destroy']);

//previous employeement api's
Route::post('/save_previous_employeement', [ApplicantPreviousEmployeementController::class, 'store']);
Route::post('/update_previous_employeement/id/{id}', [ApplicantPreviousEmployeementController::class, 'update']);
Route::get('/get_previous_experience/id/{id}', [ApplicantPreviousEmployeementController::class, 'getPreviousEmployeement']);
Route::get('/get_previous_employeements/id/{applicant_id}', [ApplicantPreviousEmployeementController::class, 'show']);
Route::delete('/delete_previous_employeement/id/{applicant_id}', [ApplicantPreviousEmployeementController::class, 'destroy']);

//applicant language api's
Route::post('/save_applicant_language', [ApplicantLanguagesController::class, 'store']);
Route::post('/update_applicant_language/id/{id}', [ApplicantLanguagesController::class, 'update']);
Route::get('/get_applicant_language/id/{id}', [ApplicantLanguagesController::class, 'getApplicantLanguage']);
Route::get('/get_applicant_languages/id/{applicant_id}', [ApplicantLanguagesController::class, 'show']);
Route::delete('/delete_application_language/id/{id}', [ApplicantLanguagesController::class, 'destroy']);

//application staff response api's
Route::post('/save_application_staff_response', [ApplicationStaffResponseController::class, 'store']);
Route::post('/update_application_staff_response/id/{id}', [ApplicationStaffResponseController::class, 'update']);
Route::get('/get_application_staff_response/id/{id}', [ApplicationStaffResponseController::class, 'getApplicationStaffResponse']);
Route::get('/get_application_staff_responses/id/{applicant_id}', [ApplicationStaffResponseController::class, 'show']);
Route::delete('/delete_application_staff_response/id/{applicant_id}', [ApplicationStaffResponseController::class, 'destroy']);

//commission response api's
Route::post('/save_comission', [CommissionController::class, 'store']);
Route::post('/update_comission/id/{id}', [CommissionController::class, 'update']);
Route::get('/get_comission/id/{id}', [CommissionController::class, 'getComission']);
Route::get('/get_comissions/id/{applicant_id}', [CommissionController::class, 'show']);
Route::delete('/delete_comission/id/{applicant_id}', [CommissionController::class, 'destroy']);

//dashboard api's
Route::get('/get_counts', [DashboardController::class, 'getCounts']);
  // });
