<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Event;
use App\Models\KategoriKegiatan;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class AgendaListController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $agenda = Event::where('title', 'like', "%{$search}%")
                ->orWhere('pakaian', 'like', "%{$search}%")
                ->orWhere('dihadiri', 'like', "%{$search}%")
                ->orWhereHas('ruangan', function ($query) use ($search) {
                    $query->where('nama_ruangan', 'like', "%{$search}%");
                })
                ->paginate(10);
        } else {
            $agenda = Event::paginate(10);
        }

        $ruangan = Ruangan::all();
        return view('pages.agenda.index', compact(['agenda', 'ruangan', 'search']));
    }

    public function create()
    {
        $kategori = KategoriKegiatan::all();
        $ruangan = Ruangan::all();
        $bidang = Bidang::all();
        if (auth()->user()->roles == 'admin') {
            return view('pages.store_event', compact('kategori', 'ruangan', 'bidang'));
        } else {
            return view('pages.pegawai.store_event', compact('kategori', 'ruangan', 'bidang'));
        }
    }
    public function delete($eventId)
    {
        Event::find($eventId)->delete();
        return redirect()->back()->with('success', 'Agenda deleted successfully');
    }
}