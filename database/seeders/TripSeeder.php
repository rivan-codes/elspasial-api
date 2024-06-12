<?php

namespace Database\Seeders;

use App\Models\LetterNecessity;
use App\Models\LetterSubmission;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $trips = [
            [
                'data'         => [
                    [
                        'name'     => 'DIPATIUKUR PUSAT',
                        'lat_long' => '-6.896982,107.615756',
                        'address'  => 'Jl. Dipati Ukur No.26c, Lebakgede, Kecamatan Coblong, Kota Bandung, Jawa Barat 40132',
                    ],
                    [
                        'name'     => 'PASTEUR',
                        'lat_long' => '-6.896982,107.615756',
                        'address'  => 'Jl. Pasteur',
                    ],
                    [
                        'name'     => 'JATIWARINGIN',
                        'lat_long' => '-6.896982,107.615756',
                        'address'  => 'Jl. Jatiwaringin No.  10',
                    ],
                    [
                        'name'     => 'BEKASI MEGA HYPERMALL',
                        'lat_long' => '-6.248915,106.992872',
                        'address'  => 'Bekasi, RT.004/RW.001, Marga Jaya, Bekasi Selatan, Bekasi, West Java 17141',
                    ]
                ],
                'start_date' => '2024-05-13 04:15',
                'end_date'   => '2024-05-13 07:30',
                'price'      => 140000,
            ],
            [
                'data'         => [
                    [
                        'name'     => 'BANDARA SOEKARNO HATTA',
                        'lat_long' => '-6.123136,106.654846',
                        'address'  => 'Jl. P21 337-121, RT.001/RW.010, Pajang, Kec. Benda, Kota Tangerang, Banten 15126',
                    ],
                    [
                        'name'     => 'STASIUN KIARACONDONG',
                        'lat_long' => '-6.923758,107.6516254',
                        'address'  => 'Kebun Jayanti, Kiaracondong, Bandung City, West Java',
                    ],
                ],
                'start_date' => '2024-05-17 13:00',
                'end_date'   => '2024-05-17 15:00',
                'price'      => 135000,
            ],
            [
                'data'         => [
                    [
                        'name'     => 'PASTEUR',
                        'lat_long' => '-6.896201,107.589795',
                        'address'  => 'Jl. Dr. Djunjunan No.89, Pajajaran, Kec. Cicendo, Kota Bandung, Jawa Barat 40173',
                    ],
                    [
                        'name'     => 'VIRTUAL POOL HALTE VERSAILLES',
                        'lat_long' => '-6.123136,106.654846',
                        'address'  => 'Jl. P21 337-121, RT.001/RW.010',
                    ],
                    [
                        'name'     => 'BSD CITY',
                        'lat_long' => '-6.284864,106.664557',
                        'address'  => 'South Tangerang, Lengkong Wetan, Serpong Sub-District, South Tangerang City, Banten 15310',
                    ],
                ],
                'start_date' => '2024-05-18 02:00',
                'end_date'   => '2024-05-18 06:00',
                'price'      => 170000,
            ]
        ];

        foreach ($trips as $trip) {
            $model = new Trip();

            $model->data       = $trip['data'];
            $model->start_date = $trip['start_date'];
            $model->end_date   = $trip['end_date'];
            $model->price      = $trip['price'];

            $model->save();
        }
    }
}
