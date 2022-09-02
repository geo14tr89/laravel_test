<?php

use App\Http\Middleware\StatisticMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
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

Route::get('/', static function () {
    return view('home');
})->name('home');

Route::get('/login', static function () {
    return view('login');
})->name('login');

Route::get('/register', static function () {
    return view('register');
})->name('register');

Route::post(
    'user/register',
    'App\Http\Controllers\UserController@register'
)->name('user/register')->middleware(StatisticMiddleware::class);

Route::post(
    'user/login',
    'App\Http\Controllers\UserController@login'
)->name('user/login')->middleware(StatisticMiddleware::class);

Route::get(
    'user/logout',
    'App\Http\Controllers\UserController@logout'
)->name('logout')->middleware(StatisticMiddleware::class);

Route::get(
    'order/index',
    'App\Http\Controllers\OrderController@index'
)->name('order')->middleware(StatisticMiddleware::class);

Route::post(
    'order/send',
    'App\Http\Controllers\OrderController@send'
)->name('send')->middleware(StatisticMiddleware::class);

Route::get(
    'document/index',
    'App\Http\Controllers\DocumentController@index'
)->name('document')->middleware(StatisticMiddleware::class);

Route::get(
    'document/download',
    'App\Http\Controllers\DocumentController@download'
)->name('download')->middleware(StatisticMiddleware::class);

Route::group(['middleware' => ['role:admin']], function () {
    Route::get(
        '/statistic',
        'App\Http\Controllers\StatisticController@index'
    )->name('statistic-index');
    Route::post(
        '/statistic/filter',
        'App\Http\Controllers\StatisticController@filter'
    )->name('statistic-filter');
    Route::get(
        '/report/index',
        'App\Http\Controllers\ReportController@index'
    )->name('report-index');
    Route::get(
        '/report/chart',
        'App\Http\Controllers\ReportController@showChart'
    )->name('report-chart');
    Route::get(
        '/report/table',
        'App\Http\Controllers\ReportController@showTable'
    )->name('report-table');
});


