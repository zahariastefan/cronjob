<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $batch = [ // if we want to reproduce multiple jobs one at time we can use that way to the things
        new \App\Jobs\SendWelcomeEmail('laracasts/project1'),
        new \App\Jobs\SendWelcomeEmail('laracasts/project2'),
        new \App\Jobs\SendWelcomeEmail('laracasts/project3'),
    ];

    \Illuminate\Support\Facades\Bus::batch($batch)
        ->allowFailures()
        ->dispatch(); //php artisan queue:batches-table

    return view('welcome');
});
