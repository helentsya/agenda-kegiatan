<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Cuti;
use App\Models\Pegawai;
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
                ->where('is_approved', 1)
                ->get();
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

        return view('pages.cuti.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $id_user = auth()->user()->pegawai->id;
        $id_bidang = auth()->user()->pegawai->id_bidang;

        $request->validate([
            // 'id_pegawai' => 'required|numeric',
            'mulai_cuti' => 'required|date',
            'lama_cuti' => 'required|numeric|min:1',
            // 'akhir_cuti' => 'required|date',
            'alasan' => 'required|string|max:255'
        ]);

        try {
            Cuti::create([
                'jenis_cuti' => $request->jenis_cuti,
                'id_pegawai' => $id_user,
                'id_bidang' => $id_bidang,
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
