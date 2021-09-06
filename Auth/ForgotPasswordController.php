<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController as BaseController;
use App\Http\Controllers\Auth\ForgotPasswordController;

use Illuminate\Http\Request;

class ForgotPasswordController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset BaseController
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

  


     public function getResetToken(Request $request)
    {

        echo "HI";;exit;
        $this->validate($request, ['email' => 'required|email']);
        if ($request->wantsJson()) {
            $user = User::where('email', $request->input('email'))->first();
            if (!$user) {
                return response()->json(Json::response(null, trans('passwords.user')), 400);
            }
            $token = $this->broker()->createToken($user);
            return response()->json(Json::response(['token' => $token]));
        }
    }

    
}
