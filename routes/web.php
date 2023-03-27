<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RollController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactResponseController;
use App\Http\Controllers\OnlineApplicantController;
use App\Http\Controllers\OnlineApplicantResponseController;
use App\Http\Controllers\PhoneNumberController;
use App\Http\Controllers\PhoneNumberResponseController;
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
  //web routes for rolls , users and privillages
  Route::middleware('can:view-user', 'routeLog')->get('/users_list', [UserController::class, 'index']);
  Route::middleware('can:view-user', 'routeLog')->get('/users/id/{id}', [UserController::class, 'edit']);
  Route::middleware('routeLog')->get('/logout', [UserController::class, 'logout']); //logout user
  Route::middleware('can:update-user', 'routeLog')->put('/users/my_password', [UserController::class, 'changeMyPass']);
  Route::middleware('can:update-user', 'routeLog')->put('/users/password/{id}', [UserController::class, 'storePassword']);
  Route::middleware('routeLog')->get('/user_profile', [UserController::class, 'myProfile']);
  Route::middleware('can:update-user', 'routeLog')->get('/user/activity/{id}', [UserController::class, 'activeStatus']);
  Route::middleware('can:view-user', 'routeLog')->get('/user/deleted', [UserController::class, 'getDeletedUser']);
  Route::middleware('can:update-user', 'routeLog')->put('/user/active/{id}', [UserController::class, 'activeDeletedUser']); //restore deleted users
  Route::middleware('can:create-user', 'routeLog')->post('/add_user', [UserController::class, 'create']); //add a user
  Route::middleware('routeLog')->post('/sanctum/token', [UserController::class, 'authToken']);

  //web routes for the user privillages
  Route::middleware('routeLog')->get('/user/Privileges/{id}', [UserController::class, 'PrivillagesAddById']);
  Route::middleware('routeLog')->get('/user/privilege/add/{id}', [UserController::class, 'PrivillagesAddById']);

  //web routes for the rolls
  Route::middleware('routeLog')->get('/rolls', [RollController::class, 'index']);
  Route::middleware('routeLog')->post('/rolls/rollId/{id}', [RollController::class, 'store']);
  Route::middleware('routeLog')->delete('/rolls/rollId/{id}', [RollController::class, 'destroy']);
  Route::middleware('routeLog')->get('/rolls/rollPrivilege/{id}', [RollController::class, 'getRolePrivilagesById'])->name('Privillages_by_roleId');
  Route::middleware('routeLog')->get('/rolls/privilege/add', [RollController::class, 'privillagesAdd'])->name('privillages_add');

  //dashboard web routes
  Route::middleware('routeLog')->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  //web routes for the vacancy
  Route::middleware('routeLog')->middleware('can:view-vacancy')->get('/vacancy_registration', [VacancyController::class, 'index'])->name('vacancy_registration');

  //web routes for the applicants
  Route::middleware('can:create-offline-applicant', 'routeLog')->get('/applicant_registration', [ApplicantController::class, 'index']);
  Route::middleware('can:view-offline-applicant', 'routeLog')->get('/registered_applicants', [ApplicantController::class, 'registeredApplicants']);
  Route::middleware('can:update-offline-applicant', 'routeLog')->get('/edit_applicant/id/{applicant_id}', [ApplicantController::class, 'editApplicant']);
  Route::middleware('can:view-offline-applicant', 'routeLog')->get('/applicant_profile/id/{applicant_id}', [ApplicantController::class, 'applicantProfile']);
  Route::middleware(['can:view-offline-applicant', 'routeLog', 'can:view-online-applicant'])->get('/view_application/id/{id}', [ApplicantController::class, 'viewApplication']);

  //contacts web routes
  Route::middleware('can:view-contact-us', 'routeLog')->get('/registered_contacts', [ContactController::class, 'index']);

  //contact response web routes
  Route::middleware('can:view-contact-us-resp', 'routeLog')->get('/contact_response/id/{contact_id}', [ContactResponseController::class, 'index']);

  //blog post registration
  Route::middleware('can:view-blog-post', 'routeLog')->get('/blog_post_registration', [BlogPostController::class, 'index']);

  //registered online applicants 
  Route::middleware('can:view-online-applicant', 'routeLog')->get('/registered_online_applicants', [OnlineApplicantController::class, 'index']);
  Route::middleware('routeLog')->get('/online_applicant_response/id/{online_applicant_id}', [OnlineApplicantResponseController::class, 'index']);

  //mobile number addition
  Route::middleware('can:view-phone-number', 'routeLog')->get('/phone_number_registration', [PhoneNumberController::class, 'index']);
  Route::middleware('can:view-phone-number', 'routeLog')->get('/phone_number_profile/id/{phone_number_id}', [PhoneNumberController::class, 'phoneNumberProfile']);

  //phone number response
  Route::middleware('can:view-phone-number-resp', 'routeLog')->get('/phone_number_response/id/{phone_number_id}', [PhoneNumberResponseController::class, 'index']);

  Route::middleware('routeLog')->get('/logout_user', [UserController::class, 'logout_user']);
});
