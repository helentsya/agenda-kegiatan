<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    function index()
    {
        return view('landingpage.index');
    }
    public function getAgendaByBidang($id_bidang)
    {
        $events = Event::where('id_bidang', $id_bidang)->get();
        return response()->json($events);
    }
}
