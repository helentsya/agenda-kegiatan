<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Event;
use App\Models\KategoriKegiatan;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgendaListController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = Auth::user();
        $id_bidang = $user->pegawai->id_bidang;

        $query = Event::query();

        if ($id_bidang != 0 && $id_bidang != 1) {
            // Pegawai hanya melihat agenda di bidangnya
            $query->where('id_bidang', $id_bidang);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('pakaian', 'like', "%{$search}%")
                    ->orWhere('dihadiri', 'like', "%{$search}%")
                    ->orWhereHas('ruangan', function ($query) use ($search) {
                        $query->where('nama_ruangan', 'like', "%{$search}%");
                    });
            });
        }

        $agenda = $query->paginate(10);
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