<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangan = Ruangan::orderBy('created_at', 'desc')->get();
        return view('pages.ruangan.index', compact('ruangan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.ruangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'kapasitas' => 'required',
            'status_ruang' => 'required',
            'hari' => 'required|string|max:10',
            'tanggal' => 'required',
            'durasi_pemakaian' => 'required|integer|min:1|max:24',
        ]);

        try {

            Ruangan::create([
                'nama_ruangan' => $request->nama_ruangan,
                'kapasitas' => $request->kapasitas,
                'status_ruang' => $request->status_ruang,
                'hari' => $request->hari,
                'tanggal' => $request->tanggal,
                'durasi_pemakaian' => $request->durasi_pemakaian,
            ]);


            Session::flash('success', 'Ruangan Berhasil Ditambahkan');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }


        return redirect('/admin/ruangan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruangan $ruangan)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ruangan $ruangan)
    {
        $ruangan = Ruangan::findOrFail($ruangan->id);
        return view('pages.ruangan.edit', compact('ruangan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        // update data
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
            'kapasitas' => 'required|integer|min:1',
            'status_ruang' => 'required|string|in:tersedia,tidak tersedia',
            'hari' => 'required|string|max:10',
            'tanggal' => 'required|date|after_or_equal:today',
            'durasi_pemakaian' => 'required|integer|min:1|max:24',
        ]);

        try {
            Ruangan::findOrFail($ruangan->id)->update([
                'nama_ruangan' => $request->nama_ruangan,
                'kapasitas' => $request->kapasitas,
                'status_ruang' => $request->status_ruang,
                'hari' => $request->hari,
                'tanggal' => $request->tanggal,
                'durasi_pemakaian' => $request->durasi_pemakaian,
            ]);

            Session::flash('success', 'Ruangan Berhasil Diubah');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Ruangan::findOrFail($id)->delete();
            Session::flash('success', 'Ruangan Berhasil Dihapus');
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
        }

        return redirect()->back();
    }
}
