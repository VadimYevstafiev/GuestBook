<?php

return [
    'users' => [
        'seeder' => ['count_rows' => 5],
        'files' => [
            'image' => [
                'relation' => 'avatar',
                'dir' => 'avatars',
                'file' => [
                    'size' => [
                        'width' => 320,
                        'height' => 240
                    ]
                ],
            ],
        ],
    ],
    'notes' => [
        'seeder' => ['count_rows' => 100],
        'index' => [
            'count_rows' => 25,
            'left_step' => 4
        ],
        'files' => [
            'image' => [
                'relation' => 'images',
                'dir' => 'images',
                'file' => [
                    'size' => [
                        'width' => 320,
                        'height' => 240
                    ]
                ],
            ],
            'text' => [
                'relation' => 'text_files',
                'dir' => 'text_files',
                'file' => [
                    'size' => 102400
                ],
            ],
        ],
    ],
    'files' => [
        'image' =>[
            'ext' => ['jpg', 'jpeg', 'gif', 'png']
        ],
        'text' => [
            'ext' => ['txt']
        ]
    ],
    'g_recaptcha' => [
        'key' => env('G_RECAPTCHA_KEY', ""),
        'secret' => env('G_RECAPTCHA_SECRET', "")
    ],
    'tinify' => [
        'key' => env('TINIFY_API_KEY', "")
    ],
];
