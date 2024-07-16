<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Pengumuman;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{

    public function index()
    {
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->limit(3)->get();
        $ruangan = Ruangan::orderBy('nama_ruangan', 'asc')->get();
        $today = Carbon::today();

        $events = Event::where(function ($query) use ($today) {
            $query->whereDate('start_event', '<=', $today)
                ->whereDate('end_event', '>=', $today);
        })->get();

        $pastEvents = Event::whereDate('end_event', '<', $today)->get();

        return view('landingpage.index', compact('pengumuman', 'ruangan', 'events', 'pastEvents'));
    }
    public function getAgendaByBidang($id_bidang)
    {
        $today = Carbon::today(); // Mengambil tanggal hari ini
        $events = Event::where('id_bidang', $id_bidang)->where(function ($query) use ($today) {
            $query->whereDate('start_event', '<=', $today)
                ->whereDate('end_event', '>=', $today);
        })
            ->get();
        // $eventDate = Carbon::parse($events->start_event);
        // $eventDate->setLocale('id');
        // $eventTime = $eventDate->isoFormat('h:m');
        return response()->json($events);
    }
}
