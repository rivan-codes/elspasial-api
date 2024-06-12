<?php

namespace App\Http\Controllers\Driver\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'email'    => ['required', 'email'],
            'password' => 'required',
        ]);

        $credential = [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ];

        $token = Auth::guard('driver')->attempt($credential);

        if ($token === false) {
            return $this->falseResponse(__('auth.failed'));
        }

        return $this->trueResponse('Login Driver', [
            'access_token' => $token,
            'token_type'   => 'bearer',
        ]);
    }

}
