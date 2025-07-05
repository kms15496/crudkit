<?php

use Illuminate\Support\Facades\Route;
use Kaung\CrudKit\Http\Controllers\BaseCrudController;

/*
|--------------------------------------------------------------------------
| CrudKit package routes
|--------------------------------------------------------------------------
|
| These are just sample routes. You will probably publish the controller
| in your app and register specific routes per model.
|
*/

Route::get('/', function () {
    return 'CrudKit is installed!';
});