<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __invoke()
    {
        $user = Auth::guard('user')->user();

        $result = [
            'id'              => $user->id,
            'name'            => $user->name,
            'email'           => $user->email,
            'avatar'          => ($user->avatar) ? setFileUrl($user->avatar) : null,
        ];

        return $this->trueResponse('Profile', $result);
    }
}
