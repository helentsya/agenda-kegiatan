<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Http\Requests\StorePengumumanRequest;
use App\Http\Requests\UpdatePengumumanRequest;
use Illuminate\Support\Facades\Session;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = Pengumuman::orderBy('created_at', 'desc')->get();

        return view('pages.pengumuman.index', compact('info'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePengumumanRequest $request)
    {
        Pengumuman::create([
            'judul_pengumuman' => $request->judul_pengumuman,
            'isi_pengumuman' => $request->isi_pengumuman,
            'tanggal_pengumuman' => $request->tanggal_pengumuman
        ]);

        return redirect()->route('pengumuman.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $pengumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view('pages.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengumumanRequest $request, Pengumuman $pengumuman)
    {
        try {
            $pengumuman->update([
                'judul_pengumuman' => $request->judul_pengumuman,
                'isi_pengumuman' => $request->isi_pengumuman,
                'tanggal_pengumuman' => $request->tanggal_pengumuman
            ]);
            Session::flash('success', 'Pengumuman Berhasil Diubah');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        try {
            $pengumuman->delete();
            Session::flash('success', 'Pengumuman Berhasil Dihapus');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }

        return redirect()->back();
    }
}
