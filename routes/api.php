<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\VerificationController;
use App\Http\Controllers\Api\VerificationProviderController;




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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => 'api'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/profile', [AuthController::class, 'userProfile']);  
    Route::resource('/services', ServiceController::class);  
    Route::resource('/products', ProductController::class);  
    Route::resource('/providers', ProviderController::class);  
    Route::resource('/countries', CountryController::class); 
    Route::get('/provider/services/{id}', [ProviderController::class ,'providerServices']);   
});

Route::group(['prefix' => 'admin','middleware' => ['assign.guard:providerServices','jwt.auth']],function ()
{
	Route::get('/providers','ProviderController@demo');	
	 Route::post('/register', [ProviderController::class, 'register']);
});



Route::prefix('provider')->controller(ProviderController::class)->group(function () {

    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::middleware('auth:admin_api')->group(function () {
        Route::post('logout', 'logout');
        Route::post('me', 'me');
    });
});

Route::get('email/verify/{id}', [VerificationController::class,'verify'])->name('verification.verify'); // Make sure to keep this as your route name

Route::get('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/verified-user', [VerificationController::class,'isVerified'])->name('user.Verify')->middleware('auth:user_api','verified'); // Make sure to keep this as your route name  

Route::get('/verified-provider', [VerificationProviderController::class,'isVerified'])->name('provider.Verify')->middleware('auth:provider_api'); // Make sure to keep this as your route name  

Route::get('provider/verify/{id}', [VerificationProviderController::class,'Verify'])->name('provider.Verify'); // Make sure to keep this as your route name

Route::get('provider/email/resend', [VerificationProviderController::class, 'resend'])->name('resend');