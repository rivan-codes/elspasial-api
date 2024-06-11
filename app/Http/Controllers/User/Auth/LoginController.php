<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'credential' => 'required',
            'password'   => 'required',
            // 'fcm_token'  => 'required'
        ]);

        $credentialEmail = [
            'email'    => $request->input('credential'),
            'password' => $request->input('password'),
        ];

        $credentialPhone = [
            'phone'    => $request->input('credential'),
            'password' => $request->input('password'),
        ];

        $credentialIdentityNumber = [
            'identity_number' => $request->input('credential'),
            'password'        => $request->input('password'),
        ];

        $token = Auth::guard('user')->attempt($credentialEmail);

        if ($token === false) {

            $token = Auth::guard('user')->attempt($credentialPhone);

            if ($token === false) {
                if(!$token = Auth::guard('user')->attempt($credentialIdentityNumber)){
                    return $this->falseResponse(__('auth.failed'));
                }
            }
        }

        $user = User::where('email', $request->credential)
            ->orWhere('phone', $request->credential)
            ->orWhere('identity_number', $request->credential)
            ->first();

        if ($user->status_id != User::STATUS_ACTIVE) {
            return $this->falseResponse(__('auth.approval'));
        }

        $user->last_used_at = Carbon::now();
        if ($request->fcm_token) {
            $user->fcm_token = $request->fcm_token;
        }

        $user->save();

        return $this->trueResponse('Login User', [
            'access_token' => $token,
            'token_type'   => 'bearer',
        ]);
    }

}
