<?php

return [
    'credentials_file' => env('FIREBASE_CREDENTIALS', base_path('intelmice-classifier-firebase.json')),

    'database' => [
        'url' => env('FIREBASE_DATABASE_URL'),
    ],
];
