<?php

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

Route::get('/', 'App\Http\Controllers\JobController@index');

Route::get('/jobs/create',[App\Http\Controllers\JobController::class,'create'])->name('jobs.create');

Route::post('/jobs/create',[App\Http\Controllers\JobController::class,'store'])->name('jobs.store');

Route::get('/jobs/my-job',[App\Http\Controllers\JobController::class,'myjob'])->name('my.job');

Route::get('/jobs/applications',[App\Http\Controllers\JobController::class,'applicant'])->name('applicant');

Route::get('/jobs/alljobs',[App\Http\Controllers\JobController::class,'alljobs'])->name('alljobs');


Route::get('/jobs/{id}/edit',[App\Http\Controllers\JobController::class,'edit'])->name('jobs.edit');

Route::post('/jobs/{id}/edit',[App\Http\Controllers\JobController::class,'update'])->name('jobs.update');

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/jobs/{id}/{job}', [App\Http\Controllers\JobController::class, 'show'])->name('jobs.show');

Route::get('/company/{id}/{company}', [App\Http\Controllers\CompanyController::class, 'index'])->name('company.index');


Route::get('/company/create', [App\Http\Controllers\CompanyController::class, 'create'])->name('company.view');

Route::post('/company/create', [App\Http\Controllers\CompanyController::class, 'store'])->name('company.store');

Route::post('/company/coverphoto', [App\Http\Controllers\CompanyController::class, 'coverPhoto'])->name('cover.photo');

Route::post('/company/logo', [App\Http\Controllers\CompanyController::class, 'companyLogo'])->name('company.logo');

Route::get('/user/profile', [App\Http\Controllers\UserController::class, 'index'])->name('user.profile');

Route::post('user/profile/create', [App\Http\Controllers\UserController::class, 'store'])->name('profile.create');

Route::post('user/coverletter', [App\Http\Controllers\UserController::class, 'coverletter'])->name('cover.letter');

Route::post('user/resume', [App\Http\Controllers\UserController::class, 'resume'])->name('resume');

Route::post('user/avatar', [App\Http\Controllers\UserController::class, 'avatar'])->name('avatar');


Route::view('employer/register','auth.employer-register')->name('emp.register');

//Route::get("employer/register", function(){
  //  return View::make("Resources\Views\Auth.employer-register");
 //});

Route::post('employer/register', [App\Http\Controllers\EmployerRegisterController::class, 'employerRegister'])->name('employer.register');

Route::post('/applications/{id}',[App\Http\Controllers\JobController::class, 'apply'])->name('apply');

Route::post('/save/{id}',[App\Http\Controllers\FavouriteController::class, 'saveJob'])->name('save');

Route::post('/unsave/{id}',[App\Http\Controllers\FavouriteController::class, 'unsaveJob'])->name('unsave');

Route::get('/category/{id}/jobs', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');

Route::get('/company', [App\Http\Controllers\CompanyController::class, 'company'])->name('company');

Route::get('/job/mail',[App\Http\Controllers\EmailController::class, 'send'])->name('mail');
