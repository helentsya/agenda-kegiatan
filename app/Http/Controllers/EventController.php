<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\KategoriKegiatan;
use App\Models\Ruangan;
use App\Models\Bidang;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PDF;

class EventController extends Controller
{
    // fungsi controller untuk menampilkan halaman utama
    public function showCalendar(Request $request)
    {
        // if (session()->get('user') == null) return redirect()->route('login');

        $events = Event::select(['title', 'start_event', 'end_event'])->get();
        $results = array();
        foreach ($events as $event) {
            $results[] = [
                'title' => $event->title,
                'start' => $event->start_event,
                'end' => $event->end_event,
            ];
        }
        return view('pages.index', ['events' => $results]);
    }

    public function showCalendarBidang(Request $request, $id)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil id_bidang dari user tersebut
        $id_bidang_user = $user->pegawai->id_bidang;

        // Cek apakah user adalah pegawai
        if ($user->roles == 'pegawai') {
            // Cek apakah id_bidang yang diminta sesuai dengan id_bidang user
            if ($id_bidang_user != $id) {
                // Jika tidak sesuai, tampilkan pesan atau arahkan ke halaman lain
                return redirect()->route('home')->with('error', 'Anda tidak memiliki akses ke agenda bidang ini.');
            }
        }

        // Temukan bidang berdasarkan id yang diberikan
        $bidang = Bidang::find($id);

        // Ambil acara yang sesuai dengan id_bidang
        $events = Event::select(['title', 'start_event', 'end_event'])->where("id_bidang", $id)->get();

        // Siapkan data acara untuk dikirim ke view
        $results = array();
        foreach ($events as $event) {
            $results[] = [
                'title' => $event->title,
                'start' => $event->start_event,
                'end' => $event->end_event,
            ];
        }

        // Kembalikan view dengan data acara dan bidang
        if (auth()->user()->roles == 'admin') {
            return view('pages.agenda-bidang', [
                'events' => $results,
                'bidang' => $bidang,
            ]);
        } else {
            return view('pages.pegawai.agenda-bidang', [
                'events' => $results,
                'bidang' => $bidang,
            ]);
        }
    }



    public function getEventsBidangByDate(Request $request)
    {
        $id = $request->input('id');
        $date = $request->input('date');

        // Query database untuk mendapatkan acara berdasarkan tanggal
        $events = Event::with('ruangan')->where('id_bidang', $id)->whereDate('start_event', $date)->get();
        $results = array();
        foreach ($events as $event) {
            $tanggal = Carbon::parse($event->start_event);
            $tanggal->locale('id');
            $results[] = [
                'id' => $event->id,
                'title' => $event->title,
                'tempat' => $event->ruangan->nama_ruangan,
                'tanggal' => $tanggal->isoFormat('dddd, D MMMM YYYY'),
                'waktu' => $tanggal->isoFormat('h:m'),
            ];
        }

        // Kembalikan data acara dalam format JSON
        return response()->json($results);
    }

    public function deleteEventBidang(Request $request)
    {
        $id = $request->input('id');
        Event::find($id)->delete();
        return response()->json(['message' => 'Event deleted successfully']);
    }

    public function showFormEditEventBidang($eventId)
    {
        try {
            $event = Event::with('ruangan')->find($eventId);
            $ruangan = Ruangan::all();
            if ($event) {
                if (auth()->user()->id_jabatan == 1) {
                    return view('pages.edit_event_bidang', [
                        'id_bidang' => $event->id_bidang,
                        'id' => $eventId,
                        'title' => $event->title,
                        'tempat' => $event->ruangan->nama_ruangan,
                        'dihadiri' => $event->dihadiri,
                        'pakaian' => $event->pakaian,
                        'keterangan' => $event->keterangan,
                        'start_event' => $event->start_event,
                        'end_event' => $event->end_event,
                        'ruangan' => $ruangan,
                        'bidang' => Bidang::all(),
                    ]);
                } else {
                    return view('pages.pegawai.edit_event_bidang', [
                        'id_bidang' => $event->id_bidang,
                        'id' => $eventId,
                        'title' => $event->title,
                        'tempat' => $event->ruangan->nama_ruangan,
                        'dihadiri' => $event->dihadiri,
                        'pakaian' => $event->pakaian,
                        'keterangan' => $event->keterangan,
                        'start_event' => $event->start_event,
                        'end_event' => $event->end_event,
                        'ruangan' => $ruangan,
                        'bidang' => Bidang::all(),
                    ]);
                }
            } else {
                abort(404);
            }
        } catch (QueryException $th) {
            abort(500);
        }
    }
    // untuk mengelola ketika acara di ubah atau edit
    public function editEventBidang(Request $request)
    {
        try {
            Event::where('id', $request->id)->update([
                'title' => $request->input('title'),
                'id_ruangan' => $request->input('id_ruangan'),
                'id_bidang' => $request->input('id_bidang'),
                'dihadiri' => $request->input('dihadiri'),
                'pakaian' => $request->input('pakaian'),
                'keterangan' => $request->input('keterangan'),
                'start_event' => $request->input('start_event'),
                'end_event' => $request->input('end_event'),
            ]);
            Session::flash('success', 'Data Berhasil Diupdate');
        } catch (QueryException $th) {
            Session::flash('error', 'Data Gagal Diupdate: ' . $th);
        }
        if (auth()->user()->id_jabatan == '1') {
            return redirect()->route('bidang.agenda', $request->input('id_bidang'));
        } else {
            return redirect()->route('pegawai.bidang.agenda', $request->input('id_bidang'));
        }
    }

    // fungsi controller untuk mengembalikan nilai detail acara berdasarkan id acara
    public function getDetailEvent(Request $request)
    {
        $id = $request->input('id');
        // Lakukan logika untuk mengambil detail event dari database atau sumber lainnya
        // Contoh sederhana: hanya mengembalikan ID event
        $detailEvent = Event::with('ruangan')->find($id);
        $bidang = Bidang::find($detailEvent->id_bidang);
        $tanggal = Carbon::parse($detailEvent->start_event);
        $tanggal->locale('id');
        return response()->json([
            'id' => $detailEvent->id,
            'title' => $detailEvent->title,
            'tempat' => $detailEvent->ruangan->nama_ruangan,
            'bidang' => $bidang->nama_bidang,
            'dihadiri' => $detailEvent->dihadiri,
            'pakaian' => $detailEvent->pakaian,
            'keterangan' => $detailEvent->keterangan,
            'tanggal' => $tanggal->isoFormat('dddd, D MMMM YYYY'),
            'waktu' => $tanggal->isoFormat('h:m'),
        ]);
    }

    // fungsi controller untuk mengembalikan nilai kumpulan acara berdasarkan tanggal
    public function getEventsByDate(Request $request)
    {
        $date = $request->input('date');

        // Query database untuk mendapatkan acara berdasarkan tanggal
        $events = Event::with('ruangan')->whereDate('start_event', $date)->get();
        $results = array();
        foreach ($events as $event) {
            $tanggal = Carbon::parse($event->start_event);
            $tanggal->locale('id');
            $results[] = [
                'id' => $event->id,
                'title' => $event->title,
                'tempat' => $event->ruangan->nama_ruangan,
                'tanggal' => $tanggal->isoFormat('dddd, D MMMM YYYY'),
                'waktu' => $tanggal->isoFormat('h:m'),
            ];
        }

        // Kembalikan data acara dalam format JSON
        return response()->json($results);
    }

    // Fungsi Contoller untuk menghapus event berdarkan query parameter id
    public function deleteEvent($eventId)
    {
        Event::find($eventId)->delete();
        return response()->json(['message' => 'Event deleted successfully']);
    }

    // untuk menampilkan form untuk menambah acara
    public function showFormAddEvent(Request $request)
    {
        $kategori = KategoriKegiatan::all();
        $ruangan = Ruangan::all();
        $bidang = Bidang::all();
        if (auth()->user()->roles == 'admin') {
            return view('pages.store_event', compact('kategori', 'ruangan', 'bidang'));
        } else {
            return view('pages.pegawai.store_event', compact('kategori', 'ruangan', 'bidang'));
        }
    }

    // untuk mengelola ketika acara ditambahkan
    public function storeEvent(Request $request)
    {
        try {
            Event::create([
                'id_ruangan' => $request->input('id_ruangan'),
                'id_kategori' => $request->input('id_kategori'),
                'title' => $request->input('title'),
                'dihadiri' => $request->input('dihadiri'),
                'pakaian' => $request->input('pakaian'),
                'keterangan' => $request->input('keterangan'),
                'start_event' => $request->input('start_event'),
                'end_event' => $request->input('end_event'),
                'id_bidang' => $request->input('id_bidang'),
            ]);
            Session::flash('success', 'Data Berhasil Dimasukkan');
        } catch (QueryException $th) {
            Session::flash('error', $th->getMessage());
        }

        return redirect()->back();
    }


    // untuk menampilkan form untuk melakukan edit acara
    public function showFormEditEvent($eventId)
    {
        try {
            $event = Event::with('ruangan')->find($eventId);
            $ruangan = Ruangan::all();
            if ($event) {
                if (auth()->user()->roles == 'admin') {
                    return view('pages.edit_event', [
                        'id' => $eventId,
                        'title' => $event->title,
                        'tempat' => $event->ruangan->nama_ruangan,
                        'dihadiri' => $event->dihadiri,
                        'pakaian' => $event->pakaian,
                        'keterangan' => $event->keterangan,
                        'start_event' => $event->start_event,
                        'end_event' => $event->end_event,
                        'ruangan' => $ruangan
                    ]);
                } else {
                    return view('pages.pegawai.edit_event', [
                        'id' => $eventId,
                        'title' => $event->title,
                        'tempat' => $event->ruangan->nama_ruangan,
                        'dihadiri' => $event->dihadiri,
                        'pakaian' => $event->pakaian,
                        'keterangan' => $event->keterangan,
                        'start_event' => $event->start_event,
                        'end_event' => $event->end_event,
                        'ruangan' => $ruangan
                    ]);
                }
            } else {
                abort(404);
            }
        } catch (QueryException $th) {
            abort(500);
        }
    }
    // untuk mengelola ketika acara di ubah atau edit
    public function editEvent(Request $request)
    {
        try {
            Event::where('id', $request->id)->update([
                'title' => $request->input('title'),
                'id_ruangan' => $request->input('id_ruangan'),
                'dihadiri' => $request->input('dihadiri'),
                'pakaian' => $request->input('pakaian'),
                'keterangan' => $request->input('keterangan'),
                'start_event' => $request->input('start_event'),
                'end_event' => $request->input('end_event'),
            ]);
            Session::flash('success', 'Data Berhasil Diupdate');
        } catch (QueryException $th) {
            Session::flash('error', 'Data Gagal Diupdate: ' . $th);
        }

        return redirect()->back();
    }

    // Tampilkan halaman print pdf 
    public function showPrintPdf(Request $request)
    {
        return view('pages.print_pdf');
    }

    // Kembalikan acara dari antara dua tanggal inputan
    public function getEventByDateRange(Request $request)
    {
        try {
            // Mengonversi string tanggal menjadi objek Carbon
            $mulaiTanggal = Carbon::createFromFormat('Y-m-d', $request->input('mulai_tanggal'));
            $sampaiTanggal = Carbon::createFromFormat('Y-m-d', $request->input('sampai_tanggal'));

            // Memeriksa apakah format tanggal valid
            if ($mulaiTanggal === false || $sampaiTanggal === false) {
                return response()->json(['error' => true, 'message' => "Input Tanggal Belum Lengkap"], 400); // Format tanggal tidak valid
            }

            // Memeriksa apakah mulaiTanggal lebih dari sampaiTanggal
            if ($mulaiTanggal->gt($sampaiTanggal)) {
                // Tanggal awal lebih dari tanggal akhir
                return response()->json(['error' => true, 'message' => "Input Sampai Tanggal harus sebelum Input Mulai Tanggal"], 400); // Format tanggal tidak valid
            }

            $events = Event::whereBetween('start_event', [$mulaiTanggal, $sampaiTanggal])->get();
            $result = array();
            foreach ($events as $event) {
                $tanggal = Carbon::parse($event->start_event);
                $bidang = Bidang::find($event->id_bidang);
                $tanggal->locale('id');
                $result[] = [
                    'id' => $event->id,
                    'bidang' => $bidang->nama_bidang,
                    'tanggal' => $tanggal->isoFormat('dddd, D MMMM YYYY'),
                    'title' => $event->title,
                ];
            }
            return response()->json($result); // Tanggal valid dan urutan benar

        } catch (InvalidFormatException $th) {
            return response()->json(['error' => true, 'message' => "Input Tanggal Belum Lengkap"], 400); // Format tanggal tidak valid

        }
    }

    // Menampilkan preview cetak pdf
    public function downloadPdf(Request $request)
    {
        try {
            // Mengonversi string tanggal menjadi objek Carbon
            $mulaiTanggal = Carbon::createFromFormat('Y-m-d', $request->query('mulai_tanggal'));
            $sampaiTanggal = Carbon::createFromFormat('Y-m-d', $request->query('sampai_tanggal'));

            // Memeriksa apakah format tanggal valid
            if ($mulaiTanggal === false || $sampaiTanggal === false) {
                abort(404);
            }

            // Memeriksa apakah mulaiTanggal lebih dari sampaiTanggal
            if ($mulaiTanggal->gt($sampaiTanggal)) {
                // Tanggal awal lebih dari tanggal akhir
                abort(404);
            }
            $results = array();
            // $events = Event::whereBetween('start_event', [$mulaiTanggal, $sampaiTanggal])->distinct()->pluck('start_event');
            $uniqueDates = Event::selectRaw('DATE(start_event) as event_date')
                ->whereBetween('start_event', [$mulaiTanggal, $sampaiTanggal])
                ->distinct()
                ->pluck('event_date');
            foreach ($uniqueDates as $date) {
                $eventResults = array();
                $events = Event::whereDate('start_event', $date)->get();
                $ruangan = Ruangan::all();
                foreach ($events as $event) {
                    $tanggal = Carbon::parse($event->start_event);
                    $tanggal->locale('id');
                    $eventResults[] = [
                        'id' => $event->id,
                        'title' => $event->title,
                        'tempat' => $event->ruangan->nama_ruangan,
                        'dihadiri' => $event->dihadiri,
                        'pakaian' => $event->pakaian,
                        'keterangan' => $event->keterangan,
                        'tanggal' => $tanggal->isoFormat('dddd, D MMMM YYYY'),
                        'waktu' => $tanggal->isoFormat('h:m'),
                    ];
                }
                $tanggal = Carbon::parse($date);
                $tanggal->locale('id');
                $results[] = [
                    'date' => $tanggal->isoFormat('dddd, D MMMM YYYY'),
                    'events' => $eventResults,
                ];
            }
            // $pdf = PDF::loadView();
            // return view('pages.download_pdf', ['dateEvents' => $results]);
            return view('pages.download_pdf', ['dateEvents' => $results]);
            // $pdf->download();
        } catch (InvalidFormatException $th) {
            abort(500);
        }
    }
    //Print
    public function getEventsByDateRange(Request $request)
    {
        $mulaiTanggal = $request->input('mulai_tanggal');
        $sampaiTanggal = $request->input('sampai_tanggal');

        $events = Event::with('bidangs')
            ->whereBetween('tanggal', [$mulaiTanggal, $sampaiTanggal])
            ->get();

        foreach ($events as $event) {
            // Debugging data bidang
            Log::info('Event ID: ' . $event->id);
            Log::info('Bidang: ' . $event->bidang);
        }

        return response()->json($events);
    }

    public function getEventDetail(Request $request)
    {
        $eventId = $request->query('id');

        $event = Event::find($eventId);

        if ($event) {
            return response()->json($event);
        }

        return response()->json(['message' => 'Event not found'], 404);
    }
}
