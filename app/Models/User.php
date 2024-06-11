<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    const BLOOD_TYPES   = ['A', 'B', 'AB', 'O','BELUM DIKETAHUI',];
    const RELIGIONS     = ['ISLAM', 'KRISTEN', 'HINDU', 'BUDHA', 'KATHOLIK', 'KONGHUCU'];
    const GENDERS       = ['LAKI-LAKI','PEREMPUAN'];
    const MARITALS      = ['BELUM KAWIN','SUDAH KAWIN','CERAI MATI','CERAI HIDUP'];
    const FAMILY_STATUS = ['KEPALA KELUARGA', 'ISTRI', 'ANAK', 'CUCU', 'MENANTU', 'ORANG TUA', 'FAMILI LAIN'];
    const NATIONALITIES = ['WNI', 'WNA'];
    const ADDRESS       = ['BANJAR DINAS BULAKAN','BANJAR DINAS TEMBOK','BANJAR DINAS YEHBAU','BANJAR DINAS NGIS','BANJAR DINAS SEMBUNG','BANJAR DINAS DAPDAPTEBEL'];

    const STATUS_ACTIVE   = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_REJECT   = 3;
    const STATUS_PENDING  = 4;

    const DOMICILE_INSIDE  = 1;
    const DOMICILE_OUTSIDE = 2;

    const STATUS = [
        self::STATUS_ACTIVE => [
            'value' => self::STATUS_ACTIVE,
            'label' => 'Aktif',
        ],
        self::STATUS_INACTIVE => [
            'value' => self::STATUS_INACTIVE,
            'label' => 'Tidak Aktif',
        ],
        self::STATUS_REJECT => [
            'value' => self::STATUS_REJECT,
            'label' => 'Ditolak',
        ],
        self::STATUS_PENDING => [
            'value' => self::STATUS_PENDING,
            'label' => 'Menunggu Persetujuan',
        ]
    ];

    const DOMICILES = [
        self::DOMICILE_INSIDE => [
            'value' => self::DOMICILE_INSIDE,
            'label' => 'TINGGAL DI DESA'
        ],
        self::DOMICILE_OUTSIDE => [
            'value' => self::DOMICILE_OUTSIDE,
            'label' => 'TIDAK DI DESA/MERANTAU'
        ],
    ];

    protected $table = 'users';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'updated_at',
    ];

    protected $guarded = [];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function routeNotificationForFcm()
    {
        return $this->fcm_token ? [$this->fcm_token] : null;
    }

    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }
}
