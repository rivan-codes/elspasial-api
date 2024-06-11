<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class ProfileController extends Controller
{
    public function __invoke()
    {
        $user = Auth::guard('user')->user();

        $result = [
            'id'              => $user->id,
            'name'            => $user->name,
            'identity_number' => $user->identity_number,
            'email'           => $user->email,
            'phone'           => $user->phone,
            'avatar'          => ($user->avatar) ? setFileUrl($user->avatar) : null,
            'address'         => $user->address,
            'family_number'   => $user->family_number,
            'profession'      => $user->profession,
            'place_birth'     => $user->place_birth,
            'date_birth'      => $user->date_birth,
            'blood_type'      => $user->blood_type,
            'religion'        => $user->religion,
            'gender'          => $user->gender,
            'marital'         => $user->marital,
            'family_status'   => $user->family_status,
            'nationality'     => $user->nationality,
        ];

        return $this->trueResponse('Profile', $result);
    }
}
