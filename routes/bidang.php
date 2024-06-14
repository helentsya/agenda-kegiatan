<?php

use App\Http\Controllers\CutiController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\WhatsappController;
use App\Http\Controllers\AgendaBidangController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

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

Route::prefix('bidang')
    ->middleware('auth', 'bidang')
    ->as('bidang.')
    ->group(function () {
        // Route yang menggunakan controller untuk mengelola Fitur Agenda Acara
        Route::controller(AgendaBidangController::class)->group(function () {
            // Route untuk menampilkan halaman utama
            Route::get('/', 'index')->name('index');
            Route::get('/event_by_date_bidang', 'event_by_date')->name('event-by-date-bidang');
            // Route untuk mengembalikan nilai detail acara berdasarkan id acara
            Route::get('/cuti', 'cuti')->name('cuti.index');
            Route::get('/cuti/create', 'cuti_create')->name('cuti.create');
            Route::post('/cuti/store', 'cuti_store')->name('cuti.store');
            Route::get('/cuti/{id}/delete', 'cuti_delete')->name('cuti.delete');
        });

    });

