<?php

namespace App\Http\Controllers\Driver\Auth;

use App\Http\Controllers\Controller;
use App\Models\Driver;
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

        if (Driver::where('email', $request->email)->first()) {
            return $this->falseResponse('Email Already Exist');
        }

        $driver = new Driver();

        if ($request->hasFile('avatar')) {
            $driver->avatar = storeFile('driver/avatar', $request->file('avatar'), true);
        }

        $driver->name     = strtoupper( $request->name);
        $driver->email    = $request->email;
        $driver->password = Hash::make($request->password);

        $driver->save();

        $data = [
            'id'    => $driver->id,
            'email' => $driver->email,
        ];

        return $this->trueResponse('Register', $data);
    }
}
