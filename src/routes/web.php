<?php

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

Route::get('/about', static function () {
    return view('about');
})->name('about');

Route::get('/contact', static function () {
    return view('contact');
})->name('contact');

Route::get(
    '/contact/all/{id}',
    'App\Http\Controllers\ContactController@showOneMessage'
)->name('contact-data-one');

Route::get(
    '/contact/all/{id}/update',
    'App\Http\Controllers\ContactController@updateMessage'
)->name('contact-update');

Route::get(
    '/contact/all',
    'App\Http\Controllers\ContactController@allData'
)->name('contact-data');

Route::post(
    '/contact/submit',
    'App\Http\Controllers\ContactController@submit'
)->name('contact-form');

Route::post(
    '/contact/all/{id}/update',
    'App\Http\Controllers\ContactController@updateMessageSubmit'
)->name('contact-update-submit');

Route::get(
    '/contact/all/{id}/delete',
    'App\Http\Controllers\ContactController@deleteMessage'
)->name('contact-delete');

Route::get('/login', static function () {
    return view('login');
})->name('login');

Route::get('/register', static function () {
    return view('register');
})->name('register');

Route::post(
    'user/register',
    'App\Http\Controllers\UserController@register'
)->name('user/register');

Route::post(
    'user/login',
    'App\Http\Controllers\UserController@login'
)->name('user/login');

Route::get(
    'user/logout',
    'App\Http\Controllers\UserController@logout'
)->name('logout');

Route::get('user/info', [
    'middleware' => 'auth',
    'uses' => 'UserController@info'
]);

Route::get(
    'order/index',
    'App\Http\Controllers\OrderController@index'
)->name('order');

Route::post(
    'order/send',
    'App\Http\Controllers\OrderController@send'
)->name('send');

Route::get(
    'document/index',
    'App\Http\Controllers\DocumentController@index'
)->name('document');

Route::get(
    'document/download',
    'App\Http\Controllers\DocumentController@download'
)->name('download');

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


