@extends('layouts.user')

@section('content')
<main id="main-content" class="bg-gray-100 ml-56 p-4 sm:p-8 md:p-12  lg:p-16 pt-8 min-h-screen">
  <div id="button-event-container" class="button-container mt-4">
    {{-- <a href="{{ route('show-print-pdf') }}" id="kembaliButton" class="py-2.5 px-5 me-2 mb-2 text-sm font-medium 
    text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200
     hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 
    
      
    ">Kembali</a> --}}
    <button type="button" id="downloadButton" class="text-white bg-blue-700 hover:bg-blue-800 
    focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 
    me-2 mb-2 focus:outline-none">Unduh
      Berkas</button>

  </div>
  <div class="bg-white border border-gray-400 rounded-lg p-4 mt-4">
    <div id="ready-to-print">
      <center>
        <div class="kop-surat  flex justify-center align-center gap-x-2 border-b-2 pb-4 border-black">
          <div class="logo flex h-fit ">
            <img src="{{ asset('/images/logo-dinas.png') }}" class="w-16 mt-3" alt="">
          </div>
          <div class="header text-center leading-tight">
            <p class="text-black  font-bold">PEMERINTAH KOTA BANJARBARU</p>
            <p class="text-black font-bold text-2xl">DINAS KOMUNIKASI DAN INFORMATIKA</p>
            <p class="text-black font-bold text-xs">Alamat Kantor: Jl. Pangeran Suriansyah No. 5 Banjarbaru Kalimantan
              Selatan</p>
            <p class="text-black font-bold text-xs">Telp/Fax. (0511) 5200052 Email:
              diskominfo@banjarbarukota.go.id
            </p>
          </div>
          <div class="logo-empty-space w-20"></div>
        </div>
      </center>
      <hr>
      <center>
        <h2 class="text-xl font-bold">
          Rekapitulasi Jadwal
        </h2>
      </center>
      @foreach ($dateEvents as $dateEvent)

      <p class="font-bold">
        {{$dateEvent['date']}}
      </p>
      @foreach ($dateEvent['events'] as $event)
      <div class="flex pl-2">
        <div class="keterangan w-28">Waktu</div>
        <div class="divider w-2">:</div>
        <div class="value">{{$event['waktu']}}</div>
      </div>
      <div class="flex pl-2">
        <div class="keterangan w-28">Acara</div>
        <div class="divider w-2">:</div>
        <div class="value">{{$event['title']}}</div>
      </div>
      <div class="flex pl-2">
        <div class="keterangan w-28">Tempat</div>
        <div class="divider w-2">:</div>
        <div class="value">{{$event['tempat']}}</div>
      </div>
      <div class="flex pl-2">
        <div class="keterangan w-28">Dihadiri</div>
        <div class="divider w-2">:</div>
        <div class="value">{{$event['dihadiri']}}</div>
      </div>
      <div class="flex pl-2">
        <div class="keterangan w-28">Pakaian</div>
        <div class="divider w-2">:</div>
        <div class="value">{{$event['pakaian']}}</div>
      </div>
      <div class="flex pl-2">
        <div class="keterangan w-28">Keterangan</div>
        <div class="divider w-2">:</div>
        <div class="value">{{$event['keterangan']}}</div>
      </div>
      <hr class="border-b-2 border-gray-500 my-4">
      @endforeach
      @endforeach
    </div>
  </div>
</main>

<script>
  $(document).ready(function() {
    $('#downloadButton').on('click', function() {
      let doc = new jsPDF();
      var elementHTML = document.querySelector("#ready-to-print");

      doc.html(elementHTML, {
        callback: function(doc) {
          // Save the PDF
          doc.save('rekapitulasi-jadwal.pdf');
        },
        margin: [10, 10, 10, 10],
        autoPaging: 'text',
        x: 0,
        y: 0,
        width: 190, //target width in the PDF document
        windowWidth: 675 //window width in CSS pixels
      });
    });
  });
</script>
@endsection