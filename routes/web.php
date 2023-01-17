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
    /**
     * After all big modify here run a php artisan migrate:fresh if got error and retry
     **/
    foreach(range(1, 100) as $i) {
        \App\Jobs\SendWelcomeEmail::dispatch();
    }

    \App\Jobs\ProcessPayment::dispatch()->onQueue('payments'); // command :   php artisan queue:work --queue=payments,default

    return view('welcome');
});
