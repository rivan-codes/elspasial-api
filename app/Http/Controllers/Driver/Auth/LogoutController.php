<?php

namespace App\Http\Controllers\Driver\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function __invoke()
    {
        $driver = Auth::guard('driver')->user();

        if (!$driver) {
            return $this->trueResponse('Logout');
        }

        Auth::guard('user')->logout();

        return $this->trueResponse('Logout');
    }
}
