<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function getEventsByDateRange(Request $request)
    {
        $mulai_tanggal = $request->input('mulai_tanggal');
        $sampai_tanggal = $request->input('sampai_tanggal');
        $bidang_id = $request->input('bidang_id');

        $query = Event::whereBetween('tanggal', [$mulai_tanggal, $sampai_tanggal]);

        if ($bidang_id) {
            $query->where('bidang_id', $bidang_id);
        }

        $events = $query->get();

        return response()->json($events);
    }
}
