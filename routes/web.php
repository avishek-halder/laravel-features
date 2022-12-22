<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pizzactrl;
use Illuminate\Foundation\Inspiring;
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
    return view('welcome');
});
Route::get('/pizzas/{id}', [Pizzactrl::class, 'index']);
Route::get('/pizza/data', [Pizzactrl::class, 'data']);
Route::get('/test', [Pizzactrl::class, 'test']);
Route::get('/getdata', 'Pizzactrl@getdata')->middleware('isdatabaseonline');
Route::get('/getpdf', [Pizzactrl::class, 'getPdf']);
Route::get('/async', [Pizzactrl::class, 'async']);
Route::get('/log', [Pizzactrl::class, 'logmsg']);
Route::get('/sendmail', [Pizzactrl::class, 'sendMail']);
Route::get('/quote', function ()
{
    echo $quote = Inspiring::quote();
});