<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
/* Rotta che gestisce la homepage visibile agli utenti */
Route::get('/', 'HomeController@index')->name('index');

// mi definisco la rotta principale e il controller di riferimento che gestisce la views (listPostsApi)
Route::get('/vue-posts', 'PostController@listPostsApi')->name('list-posts-api');

Route::resource('/posts', 'PostController');

Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact', 'HomeController@handleContactForm')->name('contacts.send');
Route::get('/thank-you', 'HomeController@thankYou')->name('contacts.thank-you');

/* Serie di rotte che gestiscono il meccanismo di autenticazione */
Auth::routes();

Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')
    ->group(function() {
    //pagina di atterraggio dopo il login (con il prefix, l'url è /admin)
        Route::get('/', 'HomeController@index')->name('index');

        Route::resource('/posts','PostController');

        Route::resource('/categories','CategoryController');

        Route::resource('/tags','TagController');

        // rotta per la pagina profilo
        Route::get('/profile', 'HomeController@profile')->name('profile');
        Route::post('/generate-token', 'HomeController@generateToken')->name('generate-token');
    });