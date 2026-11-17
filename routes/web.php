<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sapa', function () {
    return 'Halo, kelompok 1!';
});

Route::get('/katalog',
    [KatalogController::class, 'index']
)->name('katalog.index');

Route::get('/katalog/{id}',
    [KatalogController::class, 'show']
)->whereNumber('id')
 ->name('katalog.show');



