<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Pengumuman;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    function index()
    {
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->limit(3)->get(); // Misalnya 3 pengumuman terbaru
        $ruangan = Ruangan::orderBy('nama_ruangan', 'asc')->get();

        return view('landingpage.index', compact('pengumuman', 'ruangan'));
    }
    public function getAgendaByBidang($id_bidang)
    {
        $today = Carbon::today(); // Mengambil tanggal hari ini
        $events = Event::where('id_bidang', $id_bidang)->where(function ($query) use ($today) {
            $query->whereDate('start_event', '<=', $today)
                ->whereDate('end_event', '>=', $today);
        })
            ->get();
        return response()->json($events);
    }
}