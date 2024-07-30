<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\KategoriKegiatan;
use App\Models\Ruangan;
use App\Models\Cuti;
use App\Models\Bidang;
use App\Models\Pegawai;
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
        $id_bidang = auth()->user()->pegawai->id_bidang;

        $rules = Cuti::rules($request);
        $request->validate($rules);

        $pegawai = Pegawai::find($id_user);
        $jatahCuti = $pegawai->jatahCuti;
        $waktuMasuk = Carbon::parse($pegawai->waktu_masuk);

        if ($waktuMasuk->diffInYears(Carbon::now()) < 1) {
            return back()->with('error', 'Pegawai belum bekerja lebih dari 1 tahun.');
        }
        $mulaiCuti = Carbon::parse($request->mulai_cuti);
        $akhirCuti = Carbon::parse($request->akhir_cuti);
        $lamaCuti = $mulaiCuti->diffInDays($akhirCuti) + 1;

        // Validasi durasi cuti berdasarkan jenis cuti
        switch ($request->jenis_cuti) {
            case 'cuti tahunan':
                if ($lamaCuti > $jatahCuti->cuti_tahunan) {
                    return back()->withErrors(['akhir_cuti' => 'Durasi cuti tahunan tidak boleh lebih dari jatah cuti tahunan.']);
                }
                $jatahCuti->cuti_tahunan -= $lamaCuti;
                break;
            case 'cuti besar':
                if ($lamaCuti > $jatahCuti->cuti_besar) {
                    return back()->withErrors(['akhir_cuti' => 'Durasi cuti besar tidak boleh lebih dari jatah cuti besar.']);
                }
                $jatahCuti->cuti_besar -= $lamaCuti;
                break;
            case 'cuti sakit':
                if ($lamaCuti > $jatahCuti->cuti_sakit) {
                    return back()->withErrors(['akhir_cuti' => 'Durasi cuti sakit tidak boleh lebih dari jatah cuti sakit.']);
                }
                $jatahCuti->cuti_sakit -= $lamaCuti;
                break;
            case 'cuti melahirkan':
                if ($lamaCuti > $jatahCuti->cuti_melahirkan) {
                    return back()->withErrors(['akhir_cuti' => 'Durasi cuti melahirkan tidak boleh lebih dari jatah cuti melahirkan.']);
                }
                $jatahCuti->cuti_melahirkan -= $lamaCuti;
                break;
            default:
                return back()->withErrors(['jenis_cuti' => 'Jenis cuti tidak valid.']);
        }

        $jatahCuti->save();

        Cuti::create([
            'id_pegawai' => $id_user,
            'id_bidang' => $id_bidang,
            'mulai_cuti' => $request->mulai_cuti,
            'akhir_cuti' => $request->akhir_cuti,
            'jenis_cuti' => $request->jenis_cuti,
            'lama_cuti' => $lamaCuti, // Simpan durasi cuti
            'alasan' => $request->alasan,
            'is_approved' => false
        ]);

        return redirect()->route('bidang.cuti.index')->with('success', 'Cuti berhasil diajukan.');
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
    public function cancel(Request $request, $id)
    {
        $cuti = Cuti::findOrFail($id);

        $pegawai = $cuti->pegawai;
        $jatahCuti = $pegawai->jatahCuti;

        // Mengembalikan jatah cuti berdasarkan jenis cuti
        switch ($cuti->jenis_cuti) {
            case 'cuti tahunan':
                $jatahCuti->cuti_tahunan += $cuti->lama_cuti;
                break;
            case 'cuti besar':
                $jatahCuti->cuti_besar += $cuti->lama_cuti;
                break;
            case 'cuti sakit':
                $jatahCuti->cuti_sakit += $cuti->lama_cuti;
                break;
            case 'cuti melahirkan':
                $jatahCuti->cuti_melahirkan += $cuti->lama_cuti;
                break;
        }

        // Simpan perubahan jatah cuti
        $jatahCuti->save();

        // Hapus data cuti
        $cuti->delete();

        return redirect()->route('bidang.cuti.index')->with('success', 'Cuti berhasil dibatalkan dan jatah cuti dikembalikan.');
    }
}
