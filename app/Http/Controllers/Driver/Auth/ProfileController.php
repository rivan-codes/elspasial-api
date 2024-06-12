<?php

namespace App\Http\Controllers\Driver\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __invoke()
    {
        $driver = Auth::guard('driver')->user();

        $result = [
            'id'              => $driver->id,
            'name'            => $driver->name,
            'email'           => $driver->email,
            'avatar'          => ($driver->avatar) ? setFileUrl($driver->avatar) : null,
        ];

        return $this->trueResponse('Profile', $result);
    }
}
