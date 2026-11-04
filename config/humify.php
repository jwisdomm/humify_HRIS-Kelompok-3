<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Zona Kerja Humify
    |--------------------------------------------------------------------------
    */
    'timezone' => env('HUMIFY_TIMEZONE', 'Asia/Jakarta'),

    /*
    |--------------------------------------------------------------------------
    | Konfigurasi Verifikasi Wajah
    |--------------------------------------------------------------------------
    */
    'face' => [
        'driver' => env('FACE_DRIVER', 'fake'),
        'threshold' => (float) env('FACE_MATCH_THRESHOLD', 80.0),
        'api_url' => env('FACE_API_URL', ''),
        'api_key' => env('FACE_API_KEY', ''),
        'timeout' => 10,
    ],

    /*
    |--------------------------------------------------------------------------
    | Daftar Lokasi Geofence Kantor
    |--------------------------------------------------------------------------
    */
    'geofence_locations' => [
        [
            'name' => 'Kantor Pusat Humify',
            'latitude' => -6.2087634,
            'longitude' => 106.845599,
            'radius_m' => 100,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Hari Libur Mingguan untuk Karyawan Regular
    | 0 = Minggu, 6 = Sabtu (Carbon dayOfWeek)
    |--------------------------------------------------------------------------
    */
    'weekly_holidays' => [0, 6],

    /*
    |--------------------------------------------------------------------------
    | Hari Libur Nasional (Format: YYYY-MM-DD)
    |--------------------------------------------------------------------------
    */
    'national_holidays' => [
        '2026-01-01', // Tahun Baru Masehi
        '2026-02-17', // Tahun Baru Imlek
        '2026-03-20', // Hari Raya Idul Fitri
        '2026-03-21', // Hari Raya Idul Fitri
        '2026-04-03', // Wafat Yesus Kristus
        '2026-05-01', // Hari Buruh Internasional
        '2026-05-14', // Kenaikan Yesus Kristus
        '2026-05-27', // Hari Raya Idul Adha
        '2026-06-01', // Hari Lahir Pancasila
        '2026-06-16', // Tahun Baru Islam
        '2026-08-17', // Hari Kemerdekaan RI
        '2026-08-25', // Maulid Nabi Muhammad SAW
        '2026-12-25', // Hari Raya Natal
    ],

    /*
    |--------------------------------------------------------------------------
    | Flag & Asumsi Bagian 12
    |--------------------------------------------------------------------------
    */
    // Pembatalan cuti yang sudah disetujui oleh HR (default false)
    'hr_cancel_approved' => (bool) env('HUMIFY_HR_CANCEL_APPROVED', false),

    // Role yang boleh mengelola akun pengguna (default: super_admin)
    'account_roles' => array_map('trim', explode(',', env('HUMIFY_ACCOUNT_ROLES', 'super_admin'))),

    // Pemetaan leave_type_id atau leave_type_name ke attendance status (default kosong)
    'leave_type_attendance_map' => [],
];

