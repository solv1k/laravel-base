<?php

return [

    /*
     * The following skeleton will be downloaded for each new package.
     * Default: https://github.com/Jeroen-G/packager-skeleton/archive/master.zip
     */
    'skeleton' => 'https://github.com/solv1k/laravel-packager-skeleton-api/archive/master.zip',

    /*
     * When you run into issues downloading the skeleton, this might be because of
     * a file regarding SSL certificates missing on the (Windows) OS.
     * This can be solved by setting the verification of the certificate to false.
     * Of course this means it will be less secure.
     */
    'curl_verify_cert' => env('CURL_VERIFY', false),

    /**
     * On slow connections, setting a larger timeout might help to finish downloading package files.
     * Default: 60.
     */
    'timeout' => '60',

    /*
     * You can set defaults for the following placeholders.
     */
    'author_name' => 'Preon',
    'author_email' => 'dev@preon.tech',
    'author_homepage' => 'https://preon.tech',
    'license' => 'MIT',
];
