<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AdsController;
use App\Http\Controllers\Api\MemebershipController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\VerificationController;
use App\Http\Controllers\Api\VerificationProviderController;
use App\Http\Controllers\Api\ExpertiseController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PriceOfferController;


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
        Route::get('/showProviders', [ UserController::class,'showProviders']);
        Route::get('/showHome', [ UserController::class,'showHome']);
         Route::post('/search/product', [ UserController::class,'searchProduct']);


       
    });
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/profile', [AuthController::class, 'userProfile']);  
    Route::resource('/services', ServiceController::class);  
    Route::resource('/products', ProductController::class);  
    Route::resource('/providers', ProviderController::class);  
    Route::resource('/countries', CountryController::class); 
    Route::resource('/users', UserController::class); 
    Route::resource('/orders', OrderController::class); 
    Route::get('/provider/services/{id}', [ProviderController::class ,'providerServices']); 
    Route::get('/show/provider/{id}', [ ProviderController::class,'showProvider']);
    Route::post('/order/add/{id}', [OrderController::class ,'addOrder'])->name('order.add')->middleware('auth:user_api'); 

    Route::post('/order/delivery/{id}', [OrderController::class ,'delivery'])->name('order.delivery'); 

    Route::post('/order/reject/{id}', [OrderController::class ,'reject'])->name('order.reject')->middleware('auth:provider_api');

    Route::post('reject/reason/order/{id}', [OrderController::class ,'rejectReason'])->name('reject.reason.order');

    Route::get('/provider/orders', [OrderController::class,'providerOrders'])->name('provider.orders');

    // Route::get('/provider/orders', [OrderController::class,'providerOrders'])->middleware('auth:provider_api');
    Route::get('/user/orders', [OrderController::class,'userOrders'])->middleware('auth:user_api');

});

Route::get('show/order/{id}', [OrderController::class ,'showOrder'])->name('show.order'); 

 Route::post('/price/offer/{id}', [PriceOfferController::class ,'addPriceOffer'])->name('price.offer')->middleware('auth:provider_api'); 
 Route::post('/offer/reject/{id}', [PriceOfferController::class ,'reject'])->name('offer.reject'); 

 Route::post('offer/accept/{id}', [PriceOfferController::class ,'accept'])->name('offer.accept'); 

 Route::post('reject/reason/{id}', [PriceOfferController::class ,'rejectReason'])->name('reject.reason');

 Route::get('show/offer/{id}', [PriceOfferController::class ,'showOffer'])->name('show.offer'); 

Route::group(['prefix' => 'admin','middleware' => ['assign.guard:providerServices','jwt.auth']],function ()
{
	Route::get('/providers','ProviderController@demo');	
	 Route::post('/register', [ProviderController::class, 'register']);
});




// Route::prefix('products')->controller(ProductController::class)->group(function () {
//     Route::middleware('auth:admin_api')->group(function () {
//         Route::post('/', 'store');
//         Route::post('update/{id}', 'update');
//         Route::delete('/{id}', 'delete');
//     });

//     Route::middleware('auth:customer_api')->group(function () {
//         Route::get('/', 'getAllProduct');
//         Route::get('/{id}', 'show');
        
//     });
// });

Route::prefix('provider')->controller(AdsController::class)->group(function () {
    Route::get('/showAds','showAds');
    Route::get('/showOffer','showOffer');
    Route::post('/createAds','createAds');
    Route::get('/adsAndOffers','adsAndOffers');
});

Route::prefix('provider')->controller(MemebershipController::class)->group(function () {
 Route::get('/showMembership', 'showMembership');
 Route::get('/providerMembership/{id}', 'providerMembership');
 });

Route::prefix('provider')->controller(ExpertiseController::class)->group(function () {
    Route::get('/showExpertises', 'showExpertises');
});


// Route::prefix('admin')->controller(AuthController::class)->group(function () {});
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