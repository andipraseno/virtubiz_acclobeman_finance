<?php

use Illuminate\Support\Facades\Route;

Route::prefix('home')->group(function () {
    Route::get('/', 'api\HomeController@index');
});

Route::prefix('fasilitas')->group(function () {
    Route::get('/', 'api\FasilitasController@index');
    Route::get('/detail', 'api\FasilitasController@detail');
    Route::get('image/{filename}', 'api\FasilitasController@getImage');
});

Route::prefix('olahraga')->group(function () {
    Route::get('/', 'api\OlahragaController@index');
    Route::get('/list/{group_id}', 'api\OlahragaController@list');
    Route::get('/image/{filename}', 'api\OlahragaController@getImage');
});

Route::prefix('lapangan')->group(function () {
    Route::get('/list/{group_id}', 'api\LapanganController@index');
    Route::get('/peek/{id}', 'api\LapanganController@peek');
    Route::get('/image/{filename}', 'api\LapanganController@getImage');
});
