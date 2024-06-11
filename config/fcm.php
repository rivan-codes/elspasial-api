<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', ''),
        'sender_id' => env('FCM_SENDER_ID', ''),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],

    // 'fcm_user_server_key'     => env('FCM_USER_SERVER_KEY'),
    // 'fcm_user_sender_id'      => env('FCM_USER_SENDER_ID'),
    // 'fcm_authority_server_key'    => env('FCM_GUGUS_SERVER_KEY'),
    // 'fcm_authority_sender_id'     => env('FCM_GUGUS_SENDER_ID'),
];
