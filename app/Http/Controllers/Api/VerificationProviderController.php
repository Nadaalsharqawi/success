<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\RedirectsUsers;
use App\ApiCode;
use Auth ;
use App\Models\Provider;

class VerificationProviderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails, RedirectsUsers;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth:provider_api')->only('verify', 'resend');
        // $this->middleware('signed')->only('verify');
    //$this->middleware('throttle:6,1')->only('verify', 'resend');

    }

    public function verify($user_id, Request $request) {
        if (!$request->hasValidSignature()) {
            return response()->json(["msg" => "Invalid/Expired url provided."], 401);
        }

        $user = Provider::findOrFail($user_id)->first();

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

         return response(['message'=>'Successfully verified']);
    }

    public function resend() {
        if (auth()->guard('provider_api')->user()->hasVerifiedEmail()) {
            return response()->json(["msg" => "Email already verified."], 400);
        }

        auth()->guard('provider_api')->user()->sendEmailVerificationNotification();

        return response()->json(["msg" => "Email verification link sent on your email "]);
    }


    public function isVerified() {
       $provider =Auth::guard('provider_api')->user();
       if ($provider->hasVerifiedEmail()) {
           dd('your are verified');
       }
    else  {
        dd('your are not verified');

    }
       
   }


}
