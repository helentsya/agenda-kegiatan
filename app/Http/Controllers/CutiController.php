<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CutiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cuti = Cuti::with('pegawai')->orderBy('created_at', 'desc')->get();
        return view('pages.cuti.index', compact('cuti'));
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
        $id_user = auth()->user()->pegawai->id;

        $request->validate([
            // 'id_pegawai' => 'required|numeric',
            'mulai_cuti' => 'required|date',
            'lama_cuti' => 'required|numeric|min:1',
            // 'akhir_cuti' => 'required|date',
            'alasan' => 'required|string|max:255'
        ]);

        try{
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
        } catch (\Exception $e){
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
