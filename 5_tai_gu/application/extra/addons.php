<?php

return [
    'autoload' => false,
    'hooks' => [
        'upgrade' => [
            'kefu',
        ],
        'app_init' => [
            'kefu',
        ],
        'config_init' => [
            'umeditor',
        ],
    ],
    'route' => [],
    'priority' => [],
    'domain' => '',
];
