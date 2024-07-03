<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = Auth::user();

        if ($user->roles == 'admin') {
            $pegawai = Pegawai::with('bidang')->get();
            return view('pages.admin.index', compact('pegawai'));
        } elseif ($user->roles == 'kepalapejabat') {
            $pegawai = Pegawai::with('bidang')->get();
        } else {
            $pegawai = Pegawai::with('bidang')->where('id_bidang', $user->id_bidang)->get();
        }


        return view('pages.pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $bidang = Bidang::all();
        if (
            auth()->user()->roles == 'admin'
        ) {
            return view('pages.admin.create', compact('bidang'));
        } else {
            return view('pages.pegawai.create', compact('bidang'));
        }
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

            //  Pegawai::create([
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
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $pegawai = Pegawai::findOrFail($id);
        $bidang = Bidang::all();
        if ($user->roles == 'admin') {
            return view('pages.admin.edit', compact(['pegawai', 'bidang']));
        } else {
            return view('pages.pegawai.edit', compact(['pegawai', 'bidang']));
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data input
        $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'nip' => 'required|numeric',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jabatan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',


            'password' => 'nullable',
        ]);

        // Cari data pegawai dan user berdasarkan ID
        $pegawai = Pegawai::findOrFail($id);
        $user = User::where('id_pegawai', $id)->firstOrFail();

        // Update data pegawai
        $pegawai->update([
            'nama_pegawai' => $request->nama_pegawai,
            'nip' => $request->nip,
            // 'id_bidang' => $request->id_bidang,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jabatan' => $request->jabatan,
            'alamat' => $request->alamat,


            'password' => $request->filled('password') ? Hash::make($request->password) : $pegawai->password,
        ]);

        // Update data user
        $user->update([
            'nama_user' => $request->nama_pegawai,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
            'roles' => "bidang",
        ]);
        if (auth()->user()->roles == 'admin') {
            return redirect()->route('kelola-pegawai.index')->with('update', 'Data pegawai berhasil diupdate.');
        } else {
            return redirect()->route('pegawai.kelola-pegawai.index')->with('update', 'Data pegawai berhasil diupdate.');
        }
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
