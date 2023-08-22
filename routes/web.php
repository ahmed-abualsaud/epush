<?php

use Epush\Mail\Infra\Mail\ClientAdded;
use Epush\Mail\Infra\Mail\OrderAdded;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return (new OrderAdded(['credit' => '100', 'price' => '0.15', 'balance' => '10020', 'messages_count' => '11434']));
    return (new ClientAdded(['username' => 'ahmed', 'phone' => '01126999840']));

    return view('welcome');
});
