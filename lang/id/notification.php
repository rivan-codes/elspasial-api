<?php

return [
    'meetup' => [
        'join' => [
            'title' => ':name begabung dalam kegiatan',
            'body'  => 'Tap buat cari tahu partisipan lainnya, tetap jaga prokes ya!'
        ],
        'leave' => [
            'title' => ':name keluar dari kegiatan',
            'body'  => 'Kegiatan masih berlangsung, cek selengkapnya.'
        ],
        'finish' => [
            'title' => 'Kegiatan telah diakhiri oleh :name',
            'body' => 'Terima kasih sudah menghadiri :name, cek histori kegiatan di sini.'
        ]
    ],
    'covid' => [
        'affected' => [
            'title' => 'Isolasi mandiri adalah kunci!',
            'body'  => 'Anda baru saja terkonfirmasi positif COVID-19. Tetap tenang, cari bantuan medis jika merasa sakit ya. Tap buat perbarui data kesehatan Anda.'
        ],
        'suspect' => [
            'title' => 'Potensi terpapar COVID-19',
            'body'  => 'Anda pernah kontak erat dengan orang terkonfirmasi positif COVID-19. Lanjut deteksi mandiri di sini ya.'
        ]
    ],
    'payment' => [
        'pending' => [
            'title' => 'Kamu baru saja membuat pesanan :booking_code',
            'body'  => 'Bayar sekarang, biar pesananmu segera diproses.'
        ],
        'success' => [
            'title' => 'Pembayaranmu sudah kami terima',
            'body'  => 'Lihat detail pesananmu di sini'
        ],
        'failed' => [
            'title' => 'Waktu pembayaran habis',
            'body'  => 'Kamu telah melewati batas waktu pembayaran dan pesananmu telah dibatalkan otomatis oleh sistem.'
        ]
    ],
    'order' => [
        'new' => [
            'title' => 'Booking Baru',
            'body'  => 'Lihat booking secara detail disini.'
        ],
        'reminder' => [
            'title' => ':partner antrian nomor :ticket_number sedang dilayani',
            'body'  => 'Hai :name, antrian kamu nomor :ticket_number di :partner. Estimasi pengerjaan adalah :estimate menit untuk setiap antrian. Jangan telat ya, hati-hati di perjalanan :)'
        ]
    ]
];
