<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = Pegawai::with('bidang')->get();
        return view('pages.pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bidang = Bidang::all();
        return view('pages.pegawai.create', compact('bidang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $pegawai = new Pegawai;
            $pegawai->id_bidang = $request->bidang;
            $pegawai->nip = $request->nip;
            $pegawai->nama_pegawai = $request->nama_pegawai;
            $pegawai->jenis_kelamin = $request->jenis_kelamin;
            $pegawai->tempat_lahir = $request->tempat_lahir;
            $pegawai->tanggal_lahir = $request->tanggal_lahir;
            $pegawai->jabatan = $request->jabatan;
            $pegawai->alamat = $request->alamat;
            $pegawai->save();

            $user = new User;
            $user->id_pegawai = $pegawai->id;
            $user->nama_user = $request->nama_pegawai;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->roles = "bidang";
            $user->save();

            // Pegawai::create([
            //     'id_bidang' => $request->bidang,
            //     'nip'     => $request->nip,
            //     'nama_pegawai' => $request->nama_pegawai,
            //     'jenis_kelamin' => $request->jenis_kelamin,
            //     'tempat_lahir' => $request->tempat_lahir,
            //     'tanggal_lahir' => $request->tanggal_lahir,
            //     'jabatan' => $request->jabatan,
            //     'alamat' => $request->alamat,
            // ]);
            Session::flash('success', 'Data Berhasil Dimasukkan');
        } catch (QueryException $th) {
            Session::flash('error', 'Data Gagal Dimasukkan' . $th->getMessage());
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::findOrFail($id);

        $data->delete();
        Session::flash('success', 'Data Berhasil Dihapus');
        return redirect()->back();
    }
}
