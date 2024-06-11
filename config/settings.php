<?php

return [
    'perPage'   => env('SETTING_PER_PAGE', 25),
    'village'   => env('SETTING_VILLAGE'),
    'district'  => env('SETTING_DISTRICT'),
    'city'      => env('SETTING_CITY'),
    'province'  => env('SETTING_PROVINCE'),
    'signature' => [
        'position' => env('SETTING_SIGNATURE_POSITION'),
        'name'     => env('SETTING_SIGNATURE_NAME')
    ],
    'on_process_document_default' => 'Dinas Kependudukan dan Catatan Sipil Kabupaten Buleleng',
    'letter_number'               => 1,
    'register'                    => env('SETTING_REGISTER')
];
