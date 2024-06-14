<?php

use App\Http\Controllers\CutiController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\WhatsappController;
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

Route::prefix('admin')
    ->middleware('auth', 'admin')
    ->group(function () {
        Route::controller(WhatsappController::class)->group(function () {
            Route::get('/whatsapp', 'index')->name('whatsapp.index');
            Route::post('/whatsapp', 'store')->name('whatsapp.store');
            Route::post('/whatsapp/delete_whatsapp', 'destroy')->name('whatsapp.destroy');
            Route::get('/whatsapp/get-formated-events', 'getFormatedEvents');
        });

        // Route yang menggunakan controller untuk mengelola Fitur Agenda Acara
        Route::controller(EventController::class)->group(function () {
            // Route untuk menampilkan halaman utama
            Route::get('/', 'showCalendar')->name('home');

            Route::get('/bidang/{id}/agenda', 'showCalendarBidang')->name('bidang.agenda');
            Route::get('/events-bidang-by-date', 'getEventsBidangByDate')->name('event-bidang-by-date');
            Route::get('/event-bidang-detail', 'getDetailEvent')->name('event-bidang-detail');
            Route::delete('/delete-event-bidang', 'deleteEventBidang')->name('delete-event-bidang');
            Route::get('/edit-event-bidang/{eventId}', 'showFormEditEventBidang')->name('show-edit-event-bidang');
            Route::post('/edit-event-bidang', 'editEventBidang')->name('edit-event-bidang');

            // Route untuk mengembalikan nilai detail acara berdasarkan id acara
            Route::get('/detail-event', 'getDetailEvent')->name('detail-event');
            // Route untuk mengembalikan nilai kumpulan acara berdasarkan tanggal
            Route::get('/events-by-date', 'getEventsByDate')->name('event-by-date');
            // Route untuk melakukan hapus data acara berdasarkan id
            Route::delete('/delete-event/{eventId}', 'deleteEvent')->name('delete-event');

            // Route untuk menampilkan halaman tambah acara
            Route::get('/add-event', 'showFormAddEvent')->name('show-add-event');
            // Route untuk menambah data acara
            Route::post('/add-event', 'storeEvent')->name('store-event');

            // Route untuk menampilkan halaman edit acara
            Route::get('/edit-event/{eventId}', 'showFormEditEvent')->name('show-edit-event');
            // Route untuk edit data acara
            Route::post('/edit-event', 'editEvent')->name('edit-event');

            // Route untuk menampilkan halaman print pdf
            Route::get('/print-pdf', 'showPrintPdf')->name('show-print-pdf');
            // Route untuk menampilkan halaman unduh print pdf
            Route::get('/print-pdf/unduh', 'downloadPdf')->name('download-pdf');
            // Route untuk mendapatkan acara pada rentang dua tanggal
            Route::get('/events-by-data-range', 'getEventByDateRange')->name('get-event-by-date-range');
        });

        //Kelola pegawai
        Route::resource('kelola-pegawai', PegawaiController::class);
        Route::resource('cuti', CutiController::class);
        Route::resource('ruangan', RuanganController::class);
        Route::resource('pengumuman', PengumumanController::class);
    });

Route::prefix('pegawai')
    ->middleware('auth', 'pegawai')
    ->as('pegawai.')
    ->group(function () {
        // Route yang menggunakan controller untuk mengelola Fitur Agenda Acara
        Route::controller(EventController::class)->group(function () {
            // Route untuk menampilkan halaman utama
            Route::get('/', 'showCalendar')->name('pegawai.home');
            // Route untuk mengembalikan nilai detail acara berdasarkan id acara
            // Route::get('/detail-event', 'getDetailEvent')->name('detail-event');
            // Route untuk mengembalikan nilai kumpulan acara berdasarkan tanggal
            // Route::get('/events-by-date', 'getEventsByDate')->name('event-by-date');

            // Route untuk menampilkan halaman tambah acara
            Route::get('/add-event', 'showFormAddEvent')->name('show-add-event');
            // Route untuk menambah data acara
            Route::post('/add-event', 'storeEvent')->name('store-event');

            // Route untuk menampilkan halaman edit acara
            Route::get('/edit-event/{eventId}', 'showFormEditEvent')->name('show-edit-event');
            // Route untuk edit data acara
            Route::post('/edit-event', 'editEvent')->name('edit-event');

            // Route untuk menampilkan halaman print pdf
            Route::get('/agenda', 'showPrintPdf')->name('show-print-pdf');
            // Route untuk menampilkan halaman unduh print pdf
            Route::get('/print-pdf/unduh', 'downloadPdf')->name('download-pdf');
            // Route untuk mendapatkan acara pada rentang dua tanggal
            Route::get('/events-by-data-range', 'getEventByDateRange')->name('get-event-by-date-range');
            Route::resource('ruangan', RuanganController::class)->only('index');
        });

        //Kelola pegawai
        Route::resource('cuti', CutiController::class)->only(['index', 'create', 'store']);
    });

Route::prefix('kepala')
    ->middleware('auth', 'kepalapejabat')
    ->as('kepala.')
    ->group(function () {
        // Route yang menggunakan controller untuk mengelola Fitur Agenda Acara
        Route::controller(EventController::class)->group(function () {
            // Route untuk menampilkan halaman utama
            Route::get('/', 'showCalendar')->name('kepala.home');
            // Route untuk mengembalikan nilai detail acara berdasarkan id acara
            Route::get('/detail-event', 'getDetailEvent')->name('detail-event');
            // Route untuk mengembalikan nilai kumpulan acara berdasarkan tanggal
            Route::get('/events-by-date', 'getEventsByDate')->name('event-by-date');

            // Route untuk menampilkan halaman edit acara
            Route::get('/edit-event/{eventId}', 'showFormEditEvent')->name('show-edit-event');

            // Route untuk edit data acara
            Route::post('/edit-event', 'editEvent')->name('edit-event');

            // Route untuk menampilkan halaman print pdf
            Route::get('/agenda', 'showPrintPdf')->name('show-print-pdf');
            // Route untuk menampilkan halaman unduh print pdf
            Route::get('/print-pdf/unduh', 'downloadPdf')->name('download-pdf');
            // Route untuk mendapatkan acara pada rentang dua tanggal
            Route::get('/events-by-data-range', 'getEventByDateRange')->name('get-event-by-date-range');
            Route::resource('ruangan', RuanganController::class)->only('index');
        });

        Route::put('/kepala/cuti/{id}/update', [CutiController::class, 'kepala_acc'])->name('cuti.update');
        //Kelola pegawai
        Route::resource('cuti', CutiController::class)->only(['index']);
    });


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/detail-event', [EventController::class, 'getDetailEvent'])->name('detail-event');
    Route::get('/events-by-date', [EventController::class, 'getEventsByDate'])->name('event-by-date');
    Route::get('/print-pdf/unduh', [EventController::class, 'downloadPdf'])->name('pdf');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/bidang.php';
// Route yang menggunakan controller untuk mengelola Fitur Akun
// Route::controller(UserController::class)->group(function () {
//     // Route untuk memproses login
//     Route::post('/login', 'doLogin')->name('login');
//     // Route untuk menampilkan halaman login
//     Route::get('/login', 'formLogin')->name('form-login');
//     // Route untuk memproses logouot
//     Route::get('/logout', 'doLogout')->name('do-logout');
// });
