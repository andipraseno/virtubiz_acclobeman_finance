<?php

use Illuminate\Support\Facades\Route;

Route::middleware('actasys_loader')->group(function () {
    Route::prefix('/')->group(function () {
        Route::get('/', 'actasys1\ActasysController@index');

        Route::post('/login', 'actasys1\ActasysController@login');
        Route::get('/logout', 'actasys1\ActasysController@logout');

        Route::get('/reset', 'actasys1\ResetController@index');
        Route::post('/reset_start', 'actasys1\ResetController@start');

        Route::get('/changepassword/{link_aktivasi}', 'actasys1\ChangePasswordController@index');
        Route::post('/changepassword_start', 'actasys1\ChangePasswordController@start');
    });

    Route::middleware('actasys_authorizer')->group(function () {
        Route::get('/dashboard', 'actasys2\DashboardController@index');

        Route::prefix('master')->group(function () {
            Route::get('/level1', 'master\Level1Controller@index');
            Route::get('/level1_add', 'master\Level1Controller@add');
            Route::get('/level1_edit/{id}', 'master\Level1Controller@edit');
            Route::post('/level1_save', 'master\Level1Controller@save');
            Route::get('/level1_terminate/{id}', 'master\Level1Controller@terminate');
            Route::get('/level1_activate/{id}', 'master\Level1Controller@activate');

            Route::get('/level2', 'master\Level2Controller@index');
            Route::get('/level2_add/{level1_id}', 'master\Level2Controller@add');
            Route::get('/level2_edit/{id}', 'master\Level2Controller@edit');
            Route::post('/level2_save', 'master\Level2Controller@save');
            Route::get('/level2_terminate/{id}', 'master\Level2Controller@terminate');
            Route::get('/level2_activate/{id}', 'master\Level2Controller@activate');

            Route::get('/level3', 'master\Level3Controller@index');
            Route::get('/level3_add/{level2_id}', 'master\Level3Controller@add');
            Route::post('/level3_add_save', 'master\Level3Controller@add_save');
            Route::get('/level3_edit/{id}', 'master\Level3Controller@edit');
            Route::post('/level3_edit_save', 'master\Level3Controller@edit_save');
            Route::get('/level3_terminate/{id}', 'master\Level3Controller@terminate');
            Route::get('/level3_activate/{id}', 'master\Level3Controller@activate');

            Route::get('/akun', 'master\AkunController@index');
            Route::get('/akun_add/{level2_id}', 'master\AkunController@add');
            Route::post('/akun_add_save', 'master\AkunController@add_save');
            Route::get('/akun_edit/{id}', 'master\AkunController@edit');
            Route::post('/akun_edit_save', 'master\AkunController@edit_save');
            Route::get('/akun_terminate/{id}', 'master\AkunController@terminate');
            Route::get('/akun_activate/{id}', 'master\AkunController@activate');

            Route::get('/costcenter', 'master\CostCenterController@index');
            Route::get('/costcenter_add', 'master\CostCenterController@add');
            Route::get('/costcenter_edit/{id}', 'master\CostCenterController@edit');
            Route::post('/costcenter_save', 'master\CostCenterController@save');
            Route::get('/costcenter_terminate/{costcenter_id}', 'master\CostCenterController@terminate');
            Route::get('/costcenter_activate/{costcenter_id}', 'master\CostCenterController@activate');
        });
    });
});
