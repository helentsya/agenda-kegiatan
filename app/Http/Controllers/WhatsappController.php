<?php


namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Bidang;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Models\Whatsapp;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class WhatsappController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listNomor = Whatsapp::all();
        return view('pages.whatsapp', ['listNomor' => $listNomor]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nomor_telepon' => ['required', 'regex:/^(^\+62|62|^08)(\d{3,4}-?){2}\d{3,4}$/'],
            ]);
            Whatsapp::create([
                'nomor_telepon' => $request->input('nomor_telepon'),
            ]);
            Session::flash('success', ['title' => 'Tambah Kontak', 'message' => 'Data Berhasil Dimasukkan']);
        } catch (ValidationException $th) {
            Session::flash('error', ['title' => 'Tambah Kontak', 'message' => "Format Nomor Tidak Sesuai"]);
        } catch (QueryException $th) {
            Session::flash('error', ['title' => 'Tambah Kontak', 'message' => 'Data Gagal Dimasukkan']);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request->input('nomor_id');
            Whatsapp::find($id)->delete();
            Session::flash('success', ['title' => 'Hapus Kontak', 'message' => 'Data Berhasil Dihapus']);
        } catch (QueryException $th) {
            Session::flash('error', ['title' => 'Hapus Kontak', 'message' => 'Data Gagal Dihapus']);
        }

        return redirect()->back();
    }

    public function getFormatedEvents(Request $request)
    {

        try {
            $date = $request->input('tanggal');
            $contacts = Whatsapp::pluck('nomor_telepon')->toArray();
            $events = Event::whereDate('start_event', $date)->get();
            $eventResults = array();
            foreach ($events as $index => $event) {
                $eventDate = Carbon::parse($event->start_event);
                $eventDate->setLocale('id');
                $eventTime = $eventDate->isoFormat('h:m');
                $eventNumber = $index + 1;

                $bidang = Bidang::find($event->id_bidang);
                $ruangan = Ruangan::find($event->id_ruangan);

                $eventResults[] = [
                    "var_bidang" => $bidang->nama_bidang,
                    "var_tanggal" => $eventDate->isoFormat('dddd, D MMMM YYYY'),
                    "var_agenda" => $eventNumber,
                    "var_pukul" => "$eventTime WITA. Di $ruangan->nama_ruangan.",
                    "var_acara" => $event->title,
                    "var_dihadiri" => "*$event->dihadiri*",
                    "var_pakaian" => $event->pakaian,
                    "var_keterangan" => $event->keterangan
                ];
            }

            $dataResults = [
                'wa_numbers' => $contacts,
                'events' => $eventResults,
            ];
            return response()->json($dataResults);
        } catch (\Throwable $th) {
            return response()->json(['error' => true, 'message' => $th->getLine()], 500);
        }
    }
}