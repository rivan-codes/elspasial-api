<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'name'          => ['required'],
            'email'         => ['required', 'email'],
            'password'      => ['required'],
            'avatar'        => ['file', 'mimes:jpeg,jpg,png,bmp,HEIC'],
        ]);

        if (User::where('email', $request->email)->first()) {
            return $this->falseResponse('Email Already Exist');
        }
        
        $user = new User();

        if ($request->hasFile('avatar')) {
            $user->avatar = storeFile('user/avatar', $request->file('avatar'), true);
        }

        $user->name     = strtoupper( $request->name);
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        $data = [
            'id'    => $user->id,
            'email' => $request->email,
        ];

        return $this->trueResponse('Register', $data);
    }
}
