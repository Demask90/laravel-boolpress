<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// la rotta composta sarà api/posts e in Api\PostController esegui la funzione index() 
// definisco il middleware api_token_check per verificare prima la richiesta e poi ti dà l'accesso alla lista dei post
// per effettuare una chiamata ad una API protetta da API TOKEN devo modificare il ::get con il ::post 

Route::post('/posts','Api\PostController@index')->middleware('api_token_check');

//la rotta generata e che stiamo utilizzando con il server Artisan è: http://127:0.0.1:8000/api/posts