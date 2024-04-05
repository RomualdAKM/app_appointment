<?php

return [
    'name' => 'Pulpo-Azul',
    'manifest' => [
        'name' => env('APP_NAME', 'Pulpo-Azul'),
        'short_name' => 'Pulpo-Azul',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => '/logo_pulpo.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/logo_pulpo.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/logo_pulpo.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/logo_pulpo.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/logo_pulpo.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/logo_pulpo.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/logo_pulpo.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/logo_pulpo.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/logo_pulpo.png',
            '750x1334' => '/logo_pulpo.png',
            '828x1792' => '/logo_pulpo.png',
            '1125x2436' => '/logo_pulpo.png',
            '1242x2208' => '/logo_pulpo.png',
            '1242x2688' => '/logo_pulpo.png',
            '1536x2048' => '/logo_pulpo.png',
            '1668x2224' => '/logo_pulpo.png',
            '1668x2388' => '/logo_pulpo.png',
            '2048x2732' => '/logo_pulpo.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutlink1',
                'icons' => [
                    "src" => "/logo_pulpo.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutlink2'
            ]
        ],
        'custom' => []
    ]
];
