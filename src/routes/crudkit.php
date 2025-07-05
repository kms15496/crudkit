<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => [
            'web',
            'localeSessionRedirect',
            'localizationRedirect',
            'localeViewPath'
        ],
    ],
    function () {
        // existing CrudKit demo/test routes here
    }
);
