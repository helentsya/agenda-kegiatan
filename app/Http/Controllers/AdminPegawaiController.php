<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminPegawaiController extends Controller
{
    public function index()
    {
        $users = User::where('id_jabatan', '>=', 2)
            ->where('id_jabatan', '<=', 6)
            ->get();
        $pegawai = Pegawai::where('id_jabatan', '>=', 2)
            ->where('id_jabatan', '<=', 6)
            ->get();
        return view('pages.user.index', compact('users', 'pegawai'));
    }

    // Method untuk menampilkan form tambah user
    public function create()
    {
        $bidang = Bidang::all();
        $jabatans = Jabatan::all();
        return view('pages.user.create', compact('jabatans', 'bidang'));
    }

    // Method untuk menyimpan data user
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            // $request->validate([
            //     'nama_user' => 'required|string|max:255',
            //     'username' => 'required|string|unique:users|max:255',
            //     'password' => 'required|string|min:8',
            //     'email' => 'required|string|email|max:255|unique:users',
            //     'id_jabatan' => 'required|exists:jabatans,id_jabatan',
            // ]);
            $pegawai = new Pegawai;
            $pegawai->id_bidang = $request->bidang;
            $pegawai->id_jabatan = $request->jabatan;
            $pegawai->nip = $request->nip;
            $pegawai->nama_pegawai = $request->nama_pegawai;
            $pegawai->jenis_kelamin = $request->jenis_kelamin;
            $pegawai->tempat_lahir = $request->tempat_lahir;
            $pegawai->tanggal_lahir = $request->tanggal_lahir;
            $pegawai->jabatan = $request->jabatan;
            $pegawai->alamat = $request->alamat;
            // Cek apakah jabatan ditemukan
            $jabatan = Jabatan::find($request->jabatan);
            if ($jabatan) {
                $pegawai->jabatan = $jabatan->nama_jabatan;
            } else {
                throw new \Exception('Jabatan tidak ditemukan.');
            }

            $pegawai->save();

            $user = new User;
            $user->id_pegawai = $pegawai->id;
            $user->id_bidang = $request->bidang;
            $user->nama_user = $request->nama_pegawai;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->id_jabatan = $request->jabatan;

            if ($request->jabatan >= 2 && $request->jabatan <= 6) {
                $user->roles = "pegawai";
            } else {
                $user->roles = "bidang";
            }
            $user->save();

            Session::flash('success', 'Data User Berhasil Dimasukkan');
        } catch (\Exception $e) {
            Session::flash('error', 'Data Gagal Dimasukkan: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    // Method untuk menampilkan form edit user
    public function edit($id)
    {
        $users = User::findOrFail($id);
        $bidang = Bidang::all();
        $jabatans = Jabatan::all();
        return view('pages.user.edit', compact('users', 'jabatans', 'bidang'));
    }

    // Method untuk memperbarui data user
    public function update(Request $request, $id)
    {
        try {
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

            $pegawai = Pegawai::findOrFail($id);
            $user = User::where('id_pegawai', $id)->firstOrFail();

            // Update data Pegawai
            $pegawai->id_bidang = $request->bidang;
            $pegawai->id_jabatan = $request->jabatan;
            $pegawai->nip = $request->nip;
            $pegawai->nama_pegawai = $request->nama_pegawai;
            $pegawai->jenis_kelamin = $request->jenis_kelamin;
            $pegawai->tempat_lahir = $request->tempat_lahir;
            $pegawai->tanggal_lahir = $request->tanggal_lahir;
            $pegawai->alamat = $request->alamat;

            // Cek apakah jabatan ditemukan
            $jabatan = Jabatan::find($request->jabatan);
            if ($jabatan) {
                $pegawai->jabatan = $jabatan->nama_jabatan;
            } else {
                throw new \Exception('Jabatan tidak ditemukan.');
            }
            $pegawai->save();

            // Update data User
            $user->id_pegawai = $pegawai->id;
            $user->id_bidang = $request->bidang;
            $user->nama_user = $request->nama_pegawai;
            $user->username = $request->username;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->email = $request->email;
            $user->id_jabatan = $request->jabatan;


            if ($request->id_jabatan >= 2 && $request->id_jabatan <= 6) {
                $user->roles = "pegawai";
            } else {
                $user->roles = "bidang";
            }

            $user->save();


            Session::flash('success', 'Data User Berhasil Diperbarui');
        } catch (\Exception $e) {
            Session::flash('error', 'Data Gagal Diperbarui: ' . $e->getMessage());
        }

        return redirect()->route('user.index');
    }

    // Method untuk menghapus data user
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            Session::flash('success', 'Data User Berhasil Dihapus');
        } catch (\Exception $e) {
            Session::flash('error', 'Data Gagal Dihapus: ' . $e->getMessage());
        }

        return redirect()->route('user.index');
    }
}
