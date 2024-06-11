<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\Authority;
use App\Models\User;
use App\Notifications\Registration\NewRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $rules = [
            'name'            => ['required'],
            'identity_number' => ['required', 'digits:16'],
            'phone'           => ['required'],
            'password'        => ['required'],
            'avatar'          => ['file', 'mimes:jpeg,jpg,png,bmp,HEIC'],
            'address'         => ['required', Rule::in(User::ADDRESS)],
            'domicile_id'     => ['required', Rule::in([User::DOMICILE_INSIDE, User::DOMICILE_OUTSIDE])],
            'family_number'   => ['required'],
            'profession'      => ['required'],
            'place_birth'     => ['required'],
            'date_birth'      => ['required', 'date'],
            'blood_type'      => ['required', Rule::in(User::BLOOD_TYPES)],
            'religion'        => ['required', Rule::in(User::RELIGIONS)],
            'gender'          => ['required', Rule::in(User::GENDERS)],
            'marital'         => ['required', Rule::in(User::MARITALS)],
            'family_status'   => ['required', Rule::in(User::FAMILY_STATUS)],
            'nationality'     => ['required', Rule::in(User::NATIONALITIES)],
            'father_name'     => ['required'],
            'mother_name'     => ['required'],
        ];

        if (config('settings.register') == true) {
            $user = new User();

            $rules['identity_number'] = ['required', 'digits:16', Rule::unique('users', 'identity_number')];
            $rules['phone']           = ['required', Rule::unique('users', 'phone')];

            if ($request->email) {
                $rules['email'] = ['required', 'email', Rule::unique('users', 'email')];
            }
            
        }else{
            if (!$user = User::where('identity_number', $request->identity_number)->first()) {
                return $this->falseResponse(__('auth.register.failed'));
            }

            $rules['identity_number'] = ['required', 'digits:16', Rule::unique('users', 'identity_number')->ignore($user->id)];
            $rules['phone']           = ['required', Rule::unique('users', 'phone')->ignore($user->id)];

            if ($request->email) {
                $rules['email'] = ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)];
            }

            if ($user->status_id == User::STATUS_ACTIVE) {
                return $this->falseResponse(__('auth.register.active'));
            }
    
            if ($user->status_id == User::STATUS_PENDING) {
                return $this->falseResponse(__('auth.register.pending'));
            }
        }

        $currentAddress = null;
        if ($request->domicile_id == User::DOMICILE_OUTSIDE) {
            $rules['current_address'] = ['required'];
            $currentAddress = $request->current_address;
        }

        $request->validate($rules);

        if ($request->hasFile('avatar')) {
            $user->avatar = storeFile('user/avatar', $request->file('avatar'), true);
        }

        if ($request->email) {
            $user->email = $request->email;
        }

        $user->name            = strtoupper( $request->name);
        $user->identity_number = $request->identity_number;
        $user->phone           = $request->phone;
        $user->password        = Hash::make($request->password);
        $user->address         = strtoupper($request->address);
        $user->domicile_id     = $request->domicile_id;
        $user->current_address = $currentAddress ? strtoupper($request->address) : null;
        $user->family_number   = $request->family_number;
        $user->profession      = strtoupper($request->profession);
        $user->place_birth     = strtoupper($request->place_birth);
        $user->date_birth      = $request->date_birth;
        $user->blood_type      = $request->blood_type;
        $user->religion        = $request->religion;
        $user->gender          = $request->gender;
        $user->marital         = $request->marital;
        $user->family_status   = $request->family_status;
        $user->nationality     = $request->nationality;
        $user->father_name     = strtoupper($request->father_name);
        $user->mother_name     = strtoupper($request->mother_name);
        $user->status_id       = User::STATUS_PENDING;

        DB::transaction(function() use($user) {
            $user->save();

            $authority = Authority::get();
            foreach ($authority as $auth) {
                $auth->notify(new NewRegistration($user));
            }
        });

        $data = [
            'id'              => $user->id,
            'phone'           => $request->phone,
            'identity_number' => $request->identity_number,
            'password'        => $request->password,
        ];

        return $this->trueResponse('Pendaftaran berhasil! Mohon tunggu persetujuan', $data);
    }
}
