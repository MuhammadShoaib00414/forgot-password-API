<?php

namespace App\Http\Controllers;

use App\ApiCode;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Hash;




class ForgotPasswordController extends BaseController
{
    public function forgot() {
        $credentials = request()->validate(['email' => 'required|email']);

        

        return $this->sendResponse(Password::sendResetLink($credentials),'Reset password link sent on your email id.');
    }


    public function reset(ResetPasswordRequest $request) {
        $reset_password_status = Password::reset($request->validated(), function ($user, $password) {


            $user->password =   Hash::make($password);
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return $this->sendResponse($reset_password_status,ApiCode::INVALID_RESET_PASSWORD_TOKEN);
        }

        return $this->sendResponse($reset_password_status,"Password has been successfully changed");
    }
}
