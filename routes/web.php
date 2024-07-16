<?php

use App\Http\Controllers\AdminPegawaiController;
use App\Http\Controllers\AgendaListController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\LandingPageController;
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

// Redirect root URL to landing page
Route::get('/', function () {
    return redirect()->route('landingpage.index');
})->name('root')->middleware('guest');
Route::get('/', [LandingPageController::class, 'index']);
Route::get('/agenda/{id_bidang}', [LandingPageController::class, 'getAgendaByBidang']);

Route::get('/landingpage', [LandingPageController::class, 'index'])
    ->name('landingpage.index')
    ->middleware('guest');

Route::prefix('admin')
    ->middleware('auth', 'admin')
    ->group(function () {
        Route::get('events-by-date-range', [EventController::class, 'getEventsByDateRange'])->name('admin.events-by-date-range');
        Route::get('detail-event', [EventController::class, 'getEventDetail'])->name('admin.detail-event');
        Route::controller(WhatsappController::class)->group(function () {
            Route::get('/whatsapp', 'index')->name('whatsapp.index');
            Route::post('/whatsapp', 'store')->name('whatsapp.store');
            Route::post('/whatsapp/delete_whatsapp', 'destroy')->name('whatsapp.destroy');
            Route::get('/whatsapp/get-formated-events', 'getFormatedEvents');
        });
        //New
        Route::get('/agenda', [AgendaListController::class, 'index'])->name('agenda.index');
        Route::delete('/delete-agenda/{eventId}', [AgendaListController::class, 'delete'])->name('delete-agenda');
        Route::group(['prefix' => 'jabatans'], function () {
            Route::get('/', [JabatanController::class, 'index'])->name('jabatans.index');
            Route::get('/create', [JabatanController::class, 'create'])->name('jabatans.create');
            Route::post('/', [JabatanController::class, 'store'])->name('jabatans.store');
            Route::get('/edit/{id}', [JabatanController::class, 'edit'])->name('jabatans.edit');
            Route::put('/{id}', [JabatanController::class, 'update'])->name('jabatans.update');
            Route::delete('/{id}', [JabatanController::class, 'destroy'])->name('jabatans.destroy');
        });

        Route::get('users', [AdminPegawaiController::class, 'index'])->name('user.index');
        Route::get('users/create', [AdminPegawaiController::class, 'create'])->name('user.create');
        Route::post('users', [AdminPegawaiController::class, 'store'])->name('user.store');
        Route::get('users/{id}/edit', [AdminPegawaiController::class, 'edit'])->name('user.edit');
        Route::put('users/{id}', [AdminPegawaiController::class, 'update'])->name('user.update');
        Route::delete('users/{id}', [AdminPegawaiController::class, 'destroy'])->name('user.destroy');

        Route::controller(EventController::class)->group(function () {
            Route::get('/', 'showCalendar')->name('home');

            Route::get('/bidang/{id}/agenda', 'showCalendarBidang')->name('bidang.agenda');
            Route::get('/events-bidang-by-date', 'getEventsBidangByDate')->name('event-bidang-by-date');
            Route::get('/event-bidang-detail', 'getDetailEvent')->name('event-bidang-detail');
            Route::delete('/delete-event-bidang', 'deleteEventBidang')->name('delete-event-bidang');
            Route::get('/edit-event-bidang/{eventId}', 'showFormEditEventBidang')->name('show-edit-event-bidang');
            Route::post('/edit-event-bidang', 'editEventBidang')->name('edit-event-bidang');

            Route::get('/detail-event', 'getDetailEvent')->name('detail-event');
            Route::get('/events-by-date', 'getEventsByDate')->name('event-by-date');
            Route::delete('/delete-event/{eventId}', 'deleteEvent')->name('delete-event');

            Route::get('/add-event', 'showFormAddEvent')->name('show-add-event');
            Route::post('/add-event', 'storeEvent')->name('store-event');

            Route::get('/edit-event/{eventId}', 'showFormEditEvent')->name('show-edit-event');
            Route::post('/edit-event', 'editEvent')->name('edit-event');

            Route::get('/print-pdf', 'showPrintPdf')->name('show-print-pdf');
            Route::get('/print-pdf/unduh', 'downloadPdf')->name('download-pdf');
            Route::get('/events-by-data-range', 'getEventByDateRange')->name('get-event-by-date-range');
        });
        Route::resource('kelola-pegawai', PegawaiController::class);
        Route::resource('cuti', CutiController::class);
        Route::resource('ruangan', RuanganController::class);
        Route::resource('pengumuman', PengumumanController::class);
    });

// Route::middleware('role:admin')->group(function () {
//     Route::resource('kelola-pegawai', PegawaiController::class);
// });

Route::prefix('pegawai')
    ->middleware('auth', 'pegawai')
    ->as('pegawai.')
    ->group(function () {
        Route::controller(EventController::class)->group(function () {
            Route::get('/', 'showCalendar')->name('pegawai.home');

            Route::get('/bidang/{id}/agenda', 'showCalendarBidang')->name('bidang.agenda');
            Route::get('/events-bidang-by-date', 'getEventsBidangByDate')->name('event-bidang-by-date');
            Route::get('/event-bidang-detail', 'getDetailEvent')->name('event-bidang-detail');
            Route::delete('/delete-event-bidang', 'deleteEventBidang')->name('delete-event-bidang');
            Route::get('/edit-event-bidang/{eventId}', 'showFormEditEventBidang')->name('show-edit-event-bidang');
            Route::post('/edit-event-bidang', 'editEventBidang')->name('edit-event-bidang');

            Route::get('/add-event', 'showFormAddEvent')->name('show-add-event');
            Route::post('/add-event', 'storeEvent')->name('store-event');

            Route::get('/edit-event/{eventId}', 'showFormEditEvent')->name('show-edit-event');
            Route::post('/edit-event', 'editEvent')->name('edit-event');

            Route::get('/agenda', 'showPrintPdf')->name('show-print-pdf');
            Route::get('/print-pdf/unduh', 'downloadPdf')->name('download-pdf');
            Route::get('/events-by-data-range', 'getEventByDateRange')->name('get-event-by-date-range');
            Route::resource('ruangan', RuanganController::class)->only('index');
        });

        Route::resource('kelola-pegawai', PegawaiController::class);
        Route::put('/pegawai/{id}', [\App\Http\Controllers\PegawaiController::class, 'update']);
        Route::resource('cuti', CutiController::class)->only(['index', 'create', 'store']);
    });

// Route::middleware('role:pegawai')->group(function () {
//     Route::resource('pegawai.kelola-pegawai', PegawaiController::class);
// });
Route::prefix('kepala')
    ->middleware('auth', 'kepalapejabat')
    ->as('kepala.')
    ->group(function () {
        Route::controller(EventController::class)->group(function () {
            Route::get('/', 'showCalendar')->name('kepala.home');
            Route::get('/bidang/{id}/agenda', 'showCalendarBidang')->name('bidang.agenda');

            Route::get('/event-bidang-detail', 'getDetailEvent')->name('event-bidang-detail');
            Route::get('/events-bidang-by-date', 'getEventsBidangByDate')->name('event-bidang-by-date');
            //baru
            Route::post('/edit-event-bidang', 'editEventBidang')->name('edit-event-bidang');
            Route::delete('/delete-event-bidang', 'deleteEventBidang')->name('delete-event-bidang');
            Route::get('/edit-event-bidang/{eventId}', 'showFormEditEventBidang')->name('show-edit-event-bidang');

            Route::get('/edit-event/{eventId}', 'showFormEditEvent')->name('show-edit-event');
            Route::post('/edit-event', 'editEvent')->name('edit-event');

            Route::get('/agenda', 'showPrintPdf')->name('show-print-pdf');
            Route::get('/print-pdf/unduh', 'downloadPdf')->name('download-pdf');
            Route::get('/events-by-data-range', 'getEventByDateRange')->name('get-event-by-date-range');
            Route::resource('ruangan', RuanganController::class)->only('index');
        });

        Route::resource('kelola-pegawai', PegawaiController::class);
        Route::put('/kepala/cuti/{id}/update', [CutiController::class, 'kepala_acc'])->name('cuti.update');
        Route::resource('cuti', CutiController::class)->only(['index']);
    });

// Additional redirection to landing page for specific routes if needed
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Route to dashboard, ensure users are authenticated and verified
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Protected routes for authenticated users
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
