<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke()
    {
        $user = Auth::guard('user')->user();

        if (!$user) {
            return $this->trueResponse('Logout');
        }

        $user->device_id = null;
        $user->fcm_token = null;
        $user->save();

        Auth::guard('user')->logout();

        return $this->trueResponse('Logout');
    }
}
