<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
	if (!Auth::user()) {
		return view('auth/login');
	} else {
		return redirect()->action([App\Http\Controllers\CustomAuthController::class, 'getInitialData']);
	}
});

Route::post('custom-login', [App\Http\Controllers\CustomAuthController::class, 'customLogin'])->name('login.custom');
Auth::routes();
Route::get('/home', [App\Http\Controllers\CustomAuthController::class, 'getInitialData'])->name('home');
Route::get('/logout', [App\Http\Controllers\CustomAuthController::class, 'logout'])->name('logout');
Route::resource('/profile', App\Http\Controllers\UserProfileController::class);

Route::get('/postforgot', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postforgot'])->name('postforgot');
Route::get('/postotp', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postotp'])->name('postotp');
Route::get('reset_password_with_token', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'resetPassword'])->name('resetPassword');
Route::group(['middleware' => ['auth']], function () {
	Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
	Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'search'])->name('analytics.search');
	Route::get('/user_selected_details', [App\Http\Controllers\DashboardController::class, 'user_selected_details'])->name('user_selected_details');
	// Route::get('/bdm_details', [App\Http\Controllers\DashboardController::class,'bdm_details'])->name('bdm_details');
	Route::get('/ff_brands', [App\Http\Controllers\DashboardController::class, 'ff_brands'])->name('ff_brands');
	Route::get('/patient_recruitement_trend', [App\Http\Controllers\PatientRecruitmentController::class, 'recruitement_trend'])->name('recruitement_trend');
	Route::get('/excel_export', [App\Http\Controllers\ExcelController::class, 'excel_export'])->name('excel_export');
	Route::get('/avg_cycle_count', [App\Http\Controllers\IndicationController::class, 'avg_cycle_count'])->name('avg_cycle_count');
	Route::post('/analytics_search', [App\Http\Controllers\GeneralFunctionsController::class, 'filter'])->name('analytics.search');
	Route::get('/quick_summary', [App\Http\Controllers\CustomAuthController::class, 'quicksummaryview'])->name('quick_summary');
	Route::resource('/profile', App\Http\Controllers\UserProfileController::class);
});
