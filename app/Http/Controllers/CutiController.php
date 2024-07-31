<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Cuti;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $bidang = Bidang::all();
        $pegawai = Pegawai::all();
        $id_bidang = $user->pegawai->id_bidang; // pastikan pegawai berelasi dengan user

        if ($user->roles == 'admin') {
            // Admin melihat semua data cuti
            $cuti = Cuti::with('pegawai', 'bidang')->get();
        } elseif ($user->roles == 'kepalapejabat') {
            // Kepalapejabat melihat semua data cuti dengan status is_approved 1
            $cuti = Cuti::with('pegawai', 'bidang')->get();
        } elseif ($id_bidang >= 2 && $id_bidang <= 5) {
            // Admin (id_bidang 2 hingga 5) melihat data cuti dengan status is_approved 1
            $cuti = Cuti::with('pegawai', 'bidang')
                ->where(function ($query) use ($user, $id_bidang) {
                    $query->where('is_approved', 1)
                        ->orWhere('id_pegawai', $user->pegawai->id);
                })->get();
        } else {
            // Pegawai lainnya melihat data cuti yang sesuai dengan id_bidang mereka
            $cuti = Cuti::with('pegawai', 'bidang')
                ->whereHas('pegawai', function ($query) use ($id_bidang) {
                    $query->where('id_bidang', $id_bidang);
                })
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('pages.cuti.index', compact('cuti', 'bidang', 'pegawai'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawais = Pegawai::all()->filter(function ($pegawai) {
            $waktuMasuk = Carbon::parse($pegawai->waktu_masuk);
            return $waktuMasuk->diffInYears(Carbon::now()) >= 1;
        });

        return view('pages.cuti.create', compact('pegawais'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        return redirect()->route('pegawai.cuti.index')->with('success', 'Cuti berhasil diajukan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Cuti::findOrFail($id);

        if ($data) {
            $data->update([
                'is_approved' => true
            ]);

            Session::flash('success', 'Cuti Berhasil Disetujui');
            return redirect()->back();
        }

        Session::flash('error', 'Cuti Gagal Disetujui');
        return redirect()->back();
    }

    public function kepala_acc(Request $request, string $id)
    {
        $data = Cuti::findOrFail($id);

        if ($data) {
            $data->update([
                'is_approved' => true
            ]);

            Session::flash('success', 'Cuti Berhasil Disetujui');
            return redirect()->route('kepala.cuti.index');
        }

        Session::flash('error', 'Cuti Gagal Disetujui');
        return redirect()->route('kepala.cuti.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
