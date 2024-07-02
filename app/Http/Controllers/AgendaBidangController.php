<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\KategoriKegiatan;
use App\Models\Ruangan;
use App\Models\Cuti;
use App\Models\Bidang;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use PDF;

class AgendaBidangController extends Controller
{
    // fungsi controller untuk menampilkan halaman utama
    public function index(Request $request)
    {
        // if (session()->get('user') == null) return redirect()->route('login');

        $id = Auth::user()->pegawai->id_bidang;

        $events = Event::select(['title', 'start_event', 'end_event'])->where('id_bidang', $id)->get();
        $bidang = Bidang::all();
        $results = array();
        foreach ($events as $event) {
            $results[] = [
                'title' => $event->title,
                'start' => $event->start_event,
                'end' => $event->end_event,
            ];
        }

        return view('pages.bidang.index', ['events' => $results, 'bidang']);
    }

    public function event_by_date(Request $request)
    {
        $id = Auth::user()->pegawai->id_bidang;
        $date = $request->input('date');
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

        return response()->json($results);
    }

    public function cuti(Request $request)
    {
        $id = Auth::user()->id;
        $cuti = Cuti::with('pegawai')->where('id_pegawai', $id)->orderBy('created_at', 'desc')->get();
        return view('pages.bidang.cuti.index', compact('cuti'));
    }

    public function cuti_create(Request $request)
    {
        return view('pages.bidang.cuti.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function cuti_store(Request $request)
    {
        $id_user = auth()->user()->pegawai->id;

        $request->validate([

            'mulai_cuti' => 'required|date',
            'lama_cuti' => 'required|numeric|min:1',
            'alasan' => 'required|string|max:255'

        ]);

        try {

            Cuti::create([
                'jenis_cuti' => $request->jenis_cuti,
                'id_pegawai' => $id_user,
                'mulai_cuti' => $request->mulai_cuti,
                'lama_cuti' => $request->lama_cuti,
                // 'akhir_cuti' => $request->akhir_cuti,
                'keterangan' => $request->alasan,
                'is_approved' => false
            ]);

            Session::flash('success', 'Cuti Berhasil Diajukan, Menunggu Persetujuan Admin');
        } catch (\Exception $e) {

            Session::flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    public function cuti_delete(Request $request, $id)
    {
        Session::flash('success', 'Cuti Berhasil Dibatalkan');
        $cuti = Cuti::find($id);
        if ($cuti) {
            $cuti->delete();
        }

        return redirect()->route('bidang.cuti.index');
    }
}
