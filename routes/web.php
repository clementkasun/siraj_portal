<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RollController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CandidateResponseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactResponseController;
use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::get('/', function () {
  return view('auth.login');
});


Route::middleware(['auth'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  //web routes for the vacancy
  Route::get('/vacancy_registration', [VacancyController::class, 'index'])->name('vacancy_registration');
  
});

//dashboard web routes
  
//web routes for rolls , users and privillages
Route::get('/users_list', [UserController::class, 'index']);
Route::get('/users/id/{id}', [UserController::class, 'edit']);
Route::get('/logout', [UserController::class, 'logout']); //logout user
Route::put('/users/my_password', [UserController::class, 'changeMyPass']);
Route::put('/users/password/{id}', [UserController::class, 'storePassword']);
Route::delete('/users/id/{id}', [UserController::class, 'delete']);
Route::put('/users/id/{id}', [UserController::class, 'store']);
Route::get('/users/myProfile', [UserController::class, 'myProfile']);
Route::get('/user/Privileges/{id}', [UserController::class, 'PrivillagesAddById']);
Route::get('/user/privilege/add/{id}', [UserController::class, 'PrivillagesAddById']);
Route::get('/user/activity/{id}', [UserController::class, 'activeStatus']);
Route::get('/user/deleted', [UserController::class, 'getDeletedUser']);
Route::put('/user/active/{id}', [UserController::class, 'activeDeletedUser']); //restore deleted users
Route::post('/add_user', [UserController::class, 'create']); //add a user
Route::post('/sanctum/token', [UserController::class, 'authToken']);
Route::get('/rolls', [RollController::class, 'index']);
Route::post('/rolls/rollId/{id}', [RollController::class, 'store']);
Route::delete('/rolls/rollId/{id}', [RollController::class, 'destroy']);
Route::get('/rolls/rollPrivilege/{id}', [RollController::class, 'getRolePrivilagesById'])->name('Privillages_by_roleId');
Route::get('/rolls/privilege/add', [RollController::class, 'privillagesAdd'])->name('privillages_add');

//web routes for the applicants
Route::get('/applicant_registration', [ApplicantController::class, 'index']);
Route::get('/registered_applicants', [ApplicantController::class, 'registeredApplicants']);
Route::get('/edit_applicant/id/{applicant_id}', [ApplicantController::class, 'editApplicant']);
Route::get('/applicant_profile/id/{applicant_id}', [ApplicantController::class, 'applicantProfile']);
Route::get('/view_application/id/{id}', [ApplicantController::class, 'viewApplication']);

//Candidate web routes
Route::get('/registered_candidates', [CandidateController::class, 'index']);

//Candidate response web routes
Route::get('/candidate_reponse/id/{candidate_id}', [CandidateResponseController::class, 'index']);

//contacts web routes
Route::get('/registered_contacts', [ContactController::class, 'index']);

//contact response web routes
Route::get('/contact_response/id/{contact_id}', [ContactResponseController::class, 'index']);


