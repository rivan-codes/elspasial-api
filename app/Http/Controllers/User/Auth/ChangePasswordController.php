<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class ChangePasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'current_password'          => 'required',
            'new_password'              => 'required',
            'confirm_new_password'      => 'required|same:new_password',
        ]);

        $user = Auth::guard('user')->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return $this->falseResponse(__('response.current_password'));
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return $this->trueResponse('Ubah Kata Sandi berhasil');
    }
}
