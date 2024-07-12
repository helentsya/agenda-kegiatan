<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatans = Jabatan::paginate(10);
        return view('pages.jabatan.index', compact('jabatans'));
    }

    public function create()
    {
        return view('pages.jabatan.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jabatan' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Jabatan::create($request->all());
        return redirect()->back()->with('success', 'Jabatan created successfully');
    }

    public function edit($id)
    {
        $jabatan = Jabatan::find($id);
        return view('pages.jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_jabatan' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jabatan = Jabatan::find($id);
        $jabatan->update($request->all());
        Session::flash('success', 'Jabatan Berhasil Diubah');
        return redirect('/admin/jabatans');
    }

    public function destroy($id)
    {
        Jabatan::destroy($id);
        return redirect()->back()->with('success', 'Jabatan deleted successfully');
    }
}