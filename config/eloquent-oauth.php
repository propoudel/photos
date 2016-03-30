<?php

use App\Models\Customer;

return [
    'model' => Customer::class,
    'table' => 'oauth_identities',
    'providers' => [
        'facebook' => [
            'client_id' => '181350128916148',
            'client_secret' => 'd20c11f7e903265d8d7ae1db52a233a',
            'redirect_uri' => 'http://localhost:8000/facebook/login',
            'scope' => [],
        ],
        'google' => [
            'client_id' => '696091819251-1qpd975j9vm28dq36ihk0frfo31k1fv2.apps.googleusercontent.com',
            'client_secret' => 'Jn1DOiDQuragDkjimqoo7jpL',
            'redirect_uri' => 'http://localhost:8000',
            'scope' => [],
        ],
        'github' => [
            'client_id' => '9aeb9b26142b46fefb61',
            'client_secret' => '8ec7f8693e8bdab1f79470fa8e6d106188c4f75c',
            'redirect_uri' => 'http://localhost:8000/github/login',
            'scope' => [],
        ],
        'linkedin' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/linkedin/redirect',
            'scope' => [],
        ],
        'instagram' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/instagram/redirect',
            'scope' => [],
        ],
        'soundcloud' => [
            'client_id' => '12345678',
            'client_secret' => 'y0ur53cr374ppk3y',
            'redirect_uri' => 'https://example.com/your/soundcloud/redirect',
            'scope' => [],
        ],
    ],
];
