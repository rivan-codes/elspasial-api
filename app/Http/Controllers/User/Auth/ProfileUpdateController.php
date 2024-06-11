<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\Authority;
use App\Models\User;
use App\Notifications\Registration\NewRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileUpdateController extends Controller
{
    public function __invoke(Request $request)
    {
        $model = $request->user();

        if ($request->filled('name')) {
            $request->validate([
                'name'            => 'required',
                'identity_number' => ['required','digits:16', Rule::unique('users', 'identity_number')->ignore($model->id)],
                'email'           => ['required', 'email', Rule::unique('users', 'email')->ignore($model->id)],
                'phone'           => ['required', Rule::unique('users', 'phone')->ignore($model->id)],
                'avatar'          => 'file|mimes:jpeg,jpg,png,bmp,HEIC',
                'address'         => 'required',
                'family_number'   => 'required',
                'profession'      => 'required',
                'place_birth'     => 'required',
                'date_birth'      => 'required|date',
                'blood_type'      => ['required', Rule::in(User::BLOOD_TYPES)],
                'religion'        => ['required', Rule::in(User::RELIGIONS)],
                'gender'          => ['required', Rule::in(User::GENDERS)],
                'marital'         => ['required', Rule::in(User::MARITALS)],
                'family_status'   => ['required', Rule::in(User::FAMILY_STATUS)],
                'nationality'     => ['required', Rule::in(User::NATIONALITIES)],
            ]);
    
            $model->name            = $request->name;
            $model->identity_number = $request->identity_number;
            $model->email           = $request->email;
            $model->phone           = $request->phone;
            $model->address         = $request->address;
            $model->family_number   = $request->family_number;
            $model->profession      = $request->profession;
            $model->place_birth     = $request->place_birth;
            $model->date_birth      = $request->date_birth;
            $model->blood_type      = $request->blood_type;
            $model->religion        = $request->religion;
            $model->gender          = $request->gender;
            $model->marital         = $request->marital;
            $model->family_status   = $request->family_status;
            $model->nationality     = $request->nationality;
        }

        $oldAvatar = null;
        if ($request->hasFile('avatar')) {
            $oldAvatar     = $model->avatar;
            $model->avatar = storeFile('user/avatar', $request->file('avatar'), true);
        }

        $model->save();

        if ($oldAvatar) {
            deleteFile($oldAvatar);
        }

        return $this->trueResponse('Ubah profil berhasil', 
            ['id' => $model->id]
        );
    }
}
