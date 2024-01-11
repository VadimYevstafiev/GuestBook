<?php

return [
    'users' => [
        'seeder' => ['count_rows' => 5],
        'avatar' => [
            'dir' => 'users/avatars',
            'file' => [
                'type' => 'image',
                'size' => [
                    'width' => 70,
                    'height' => 70
                ]

            ],
        ],
    ],
    'notes' => [
        'seeder' => ['count_rows' => 100],
        'index' => [
            'count_rows' => 25,
            'left_step' => 4
        ],
        'images' => [
            'dir' => 'notes/images',
            'file' => [
                'type' => 'image',
                'size' => [
                    'width' => 320,
                    'height' => 240
                ]
            ],
        ],
        'text-files' => [
            'dir' => 'notes/text-files',
            'file' => [
                'type' => 'text',
                'size' => 102400
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
