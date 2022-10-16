<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\ProductController;




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