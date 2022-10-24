<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdsController;
use App\Http\Controllers\Admin\AdsSettingController;
use App\Http\Controllers\Admin\CollegeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ProviderController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ExpertiseController;


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

Auth::routes();
Route::get('privacy', [SettingController::class, 'getPrivacy'])->name('privacy.policy');
Route::get('terms', [SettingController::class, 'getTerms'])->name('terms');
// Route::get('forget/password/get', [UserController::class, 'forgetPasswordView'])->name('forget.password.get');
// Route::post('send/code', [UserController::class, 'sendCode'])->name('send.code');
// Route::get('check/code/get', [UserController::class, 'checkCodeView'])->name('check.code.get');
// Route::post('check/code/post', [UserController::class, 'checkCode'])->name('check.code.post');
// Route::get('forget/password/view', [UserController::class, 'resetPasswordView'])->name('forget.password.view');
// Route::post('forget/password/post', [UserController::class, 'resetPassword'])->name('forget.password.post');
Route::group(['middleware' => ['lang', 'auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::resource('students', StudentController::class);
    Route::resource('providers', ProviderController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('universities', UniversityController::class);
    Route::resource('cities', CityController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('ads', AdsController::class);
    Route::resource('ads-Setting', AdsSettingController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('colleges', CollegeController::class);
    Route::resource('products', ProductController::class);
    Route::resource('expertises', ExpertiseController::class);
    Route::get('settings/change_lang/{lang}', [SettingController::class, 'changeLang'])->name('settings.changelang');
    Route::resource('memberships', MembershipController::class);
    Route::post('discounts', [MembershipController::class,'discount'])->name('memberships.discounts');
    Route::get('user/profile', [UserController::class, 'showUserProfile'])->name('user.profile');
    Route::put('user/profile/update', [UserController::class, 'updateUserProfile'])->name('user.profile.update');
    Route::get('update/password', [UserController::class, 'updatePasswordView'])->name('update.password');
    Route::post('update/password/post', [UserController::class, 'updatePassword'])->name('update.password.post');
});
