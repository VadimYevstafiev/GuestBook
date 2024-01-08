<?php

return [
    'users' => [
        'seeder' => ['count_rows' => 5]
    ],
    'notes' => [
        'seeder' => ['count_rows' => 100],
        'index' => [
            'count_rows' => 25,
            'left_step' => 4
        ]
    ],
    'g_recaptcha' => [
        'key' => env('G_RECAPTCHA_KEY', ""),
        'secret' => env('G_RECAPTCHA_SECRET', "")
    ],
];
