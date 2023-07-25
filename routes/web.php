<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
//namespace App\Http\Middleware;

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
// return view('welcome');
Route::get('/', function () {
    return view('auth/login');
});




Route::post('landing', [App\Http\Controllers\CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('resetpassworderror', [App\Http\Controllers\CustomAuthController::class, 'passwordError'])->name('resetpassworderror');
Route::post('resetpassword', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'newresetpassword'])->name('new.resetpassword');
Auth::routes();
Route::get('/home', [App\Http\Controllers\CustomAuthController::class, 'index'])->name('home');
Route::get('/pohome', [App\Http\Controllers\PoCustomAuthController::class, 'index'])->name('po');
Route::get('/postforgot', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postforgot'])->name('postforgot');
Route::get('/postotp', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'postotp'])->name('postotp');
Route::get('reset_password_with_token', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'resetPassword'])->name('resetPassword');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('/profile', App\Http\Controllers\UserProfileController::class);
    Route::resource('/po_enteries', App\Http\Controllers\PoController::class);
    Route::get('/fetch_institute_details', [App\Http\Controllers\PoController::class, 'get_institute_details'])->name('get_institute_details');
    Route::get('/fetch_sku_details', [App\Http\Controllers\PoController::class, 'get_sku_details_pts'])->name('get_sku_details_pts');
    Route::post('/save_po', [App\Http\Controllers\PoController::class, 'store'])->name('store');
    Route::resource('/rx_entries', App\Http\Controllers\RxEntryController::class);
    Route::resource('/notifications', App\Http\Controllers\NotificationsController::class);
    Route::resource('/ff', App\Http\Controllers\Admin\FfController::class);
    Route::get('/fetch_indications', [App\Http\Controllers\IndicationsController::class, 'fetch_indications'])->name('fetch_indications');
    Route::get('/fetch_sub_indications', [App\Http\Controllers\IndicationsController::class, 'fetch_sub_indications'])->name('fetch_sub_indications');
    Route::get('/fetch_sub_sub_indications', [App\Http\Controllers\IndicationsController::class, 'fetch_sub_sub_indications'])->name('fetch_sub_sub_indications');
    Route::get('/fetch_doctor_details', [App\Http\Controllers\DoctorsController::class, 'fetch_doctor_details'])->name('fetch_doctor_details');
    Route::get('/add_cycle/{id}', [App\Http\Controllers\RxEntryController::class, 'add_cycle_page'])->name('add_cycle_page');
    Route::post('/update_cycle', [App\Http\Controllers\RxEntryController::class, 'update_cycle'])->name('update_cycle');
    Route::get('/fetch_dashboard_details', [App\Http\Controllers\Admin\DashboardController::class, 'fetch_dashboard_details'])->name('fetch_dashboard_details');
    Route::get('/fetch_brandwise_rx', [App\Http\Controllers\RxEntryController::class, 'fetch_brandwise_rx'])->name('fetch_brandwise_rx');
    Route::resource('/brand_manager', App\Http\Controllers\Admin\BrandManagerController::class);
    Route::resource('/regional_manager', App\Http\Controllers\Admin\RegionalManagerController::class);
    Route::resource('/dashboard', App\Http\Controllers\Admin\DashboardController::class);
    Route::resource('/teams', App\Http\Controllers\Admin\TeamController::class);
    Route::post('/teams_search', [App\Http\Controllers\Admin\TeamController::class, 'searchTeams'])->name('teams.search');
    Route::resource('/doctors', App\Http\Controllers\Admin\DoctorController::class);
    Route::resource('/brands', App\Http\Controllers\Admin\BrandController::class);
    Route::post('/brand_search', [App\Http\Controllers\Admin\BrandController::class, 'searchBrands'])->name('brand_list.search');
    Route::post('/brand_add', [App\Http\Controllers\Admin\BrandController::class, 'addBrands'])->name('brand.add');
    Route::post('/brand_update', [App\Http\Controllers\Admin\BrandController::class, 'updateBrand'])->name('brand.update');
    Route::get('/fetch_brand_data', [App\Http\Controllers\Admin\BrandController::class, 'fetch_brand_data'])->name('fetch_brand_data');
    Route::resource('/admin_bdm', App\Http\Controllers\Admin\BdmController::class);
    Route::get('/fetch_bdm_data', [App\Http\Controllers\Admin\BdmController::class, 'fetch_bdm_data'])->name('fetch_bdm_data');
    Route::post('/bdm_update', [App\Http\Controllers\Admin\BdmController::class, 'update'])->name('admin_bdm.update');
    Route::post('/admin_bdm_search', [App\Http\Controllers\Admin\BdmController::class, 'index'])->name('admin_bdm.search');
    Route::resource('/cms', App\Http\Controllers\Admin\CmsController::class);
    Route::post('/doctors_add', [App\Http\Controllers\Admin\DoctorController::class, 'addDoctor'])->name('doctor.add');
    Route::post('/doctors_update', [App\Http\Controllers\Admin\DoctorController::class, 'updateDoctor'])->name('doctor.update');
    Route::post('/doctor_search', [App\Http\Controllers\Admin\DoctorController::class, 'index'])->name('doctor.search');
    Route::delete('/delete_doctor_data', [App\Http\Controllers\Admin\DoctorController::class, 'delete_doctor_data'])->name('doctor.delete');
    Route::get('/fetch_doctor_data', [App\Http\Controllers\Admin\DoctorController::class, 'fetch_doctor_data'])->name('delete_doctor_data');
    Route::post('/brand_update', [App\Http\Controllers\Admin\BrandController::class, 'updateBrand'])->name('brand.update');
    Route::delete('/brand/{id}', [App\Http\Controllers\Admin\BrandController::class, 'deleteBrand'])->name('brand.delete');
    Route::post('/brand_manager_add', [App\Http\Controllers\Admin\BrandManagerController::class, 'addBrandManager'])->name('brand_manager.add');
    Route::post('/brand_manager_search', [App\Http\Controllers\Admin\BrandManagerController::class, 'index'])->name('brand_manager.search');
    Route::get('/fetch_brand_manager_data', [App\Http\Controllers\Admin\BrandManagerController::class, 'fetch_brand_manager_data'])->name('fetch_brand_manager_data');
    Route::post('/brand__manager_update', [App\Http\Controllers\Admin\BrandManagerController::class, 'brand__manager_update'])->name('brand_manager.edit');
    Route::delete('/delete_manager', [App\Http\Controllers\Admin\BrandManagerController::class, 'delete_manager'])->name('delete_manager');
    Route::post('/region_add', [App\Http\Controllers\Admin\RegionalManagerController::class, 'addRegion'])->name('region.add');
    Route::post('/regional_manager/add', [App\Http\Controllers\Admin\RegionalManagerController::class, 'addRegionalManager'])->name('regional_manager.add');
    Route::post('/regional_manager_search', [App\Http\Controllers\Admin\RegionalManagerController::class, 'index'])->name('regional_manager.search');
    Route::get('/fetch_regional_manager_data', [App\Http\Controllers\Admin\RegionalManagerController::class, 'fetch_regional_manager_data'])->name('fetch_regional_manager_data');
    Route::post('/regional__manager_update', [App\Http\Controllers\Admin\RegionalManagerController::class, 'regional__manager_update'])->name('regional_manager.edit');
    Route::get('/fetch_ff_data', [App\Http\Controllers\Admin\FfController::class, 'fetch_ff_data'])->name('fetch_ff_data');
    Route::get('/filter_ff_details', [App\Http\Controllers\Admin\FfController::class, 'filter_ff_details'])->name('filter_ff_details');
    Route::get('/get_end_date', [App\Http\Controllers\GeneralFunctionsController::class, 'get_end_date'])->name('get_end_date');
});
Route::resource('/institute', App\Http\Controllers\Admin\InstituteController::class);
Route::resource('/indications', App\Http\Controllers\Admin\IndicationController::class);
Route::delete('/delete_indication', [App\Http\Controllers\Admin\IndicationController::class, 'delete_indication'])->name('delete_indication');
Route::delete('/delete_institute', [App\Http\Controllers\Admin\InstituteController::class, 'delete_institute'])->name('delete_institute');
   
//adminpanel//neethu

 
  


  
 
 






// Route::group(['middleware' => ['is_loggedin']], function () {
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// });
