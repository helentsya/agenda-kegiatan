@extends('layouts.user')

@section('content')
@php
    // Determine the prefix based on the user's role
    $prefix = '';
    if (auth()->user()->roles == 'admin') {
        $prefix = 'admin';
    } elseif (auth()->user()->roles == 'pegawai') {
        $prefix = 'pegawai';
    } elseif (auth()->user()->roles == 'kepalapejabat') {
        $prefix = 'kepala';
    }
@endphp>
<main id="main-content" class="bg-gray-100 ml-56 p-4 min-h-screen">
  <h1 class="mb-4  text-2xl leading-none tracking-tight ">
                Halo, Selamat Datang Kembali</h1>
  <div class="" id="calendar"></div>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr class>
          <th scope="col" class="px-6 py-3">
            Acara
          </th>
          <th scope="col" class="px-6 py-3">
            Tempat
          </th>
          <th scope="col" class="px-6 py-3">
            Tanggal
          </th>
          <th scope="col" class="px-6 py-3">
            Waktu
          </th>
          <th scope="col" class="px-6 py-3 col-span-3">
            Aksi
          </th>
        </tr>
      </thead>
      <tbody class="table-body-event">
        <tr>
          <td colspan="5" class="text-center bg-white py-4"> Tidak ada acara! Pilih tanggal Terlebih Dahulu </td>
        </tr>
      </tbody>
    </table>

  </div>

  <div class="send-to-wa-button-container mt-2">
  </div>

</main>
<script>
    var baseUrl = "{{ url($prefix) }}";
</script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>
// Buat komponen detail button
function createDetailButton(eventId) {
  let button = $('<button>', {
    text: 'Detail',
    class: 'text-blue-700 mt-2 mr-2 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center ',
    click: function() {
      // Ajax GET request untuk mendapatkan detail event
      $.ajax({
        url: 'detail-event',
        type: 'GET',
        data: {
          id: eventId
        },
        success: function(event) {
          // Handle data dari detail event
          console.info(event);
          Swal.fire({
            icon: 'info',
            title: 'Event Details',
            html: '<strong>Title:</strong> ' + event.title +
              '<br>' +
              '<strong>Tempat:</strong> ' + event.tempat +
              '<br>' +
              '<strong>Dihadiri:</strong> ' + event
              .dihadiri + '<br>' +
              '<strong>Pakaian:</strong> ' + event
              .pakaian + '<br>' +
              '<strong>Tanggal:</strong> ' + event.tanggal + '<br>' +
              '<strong>Waktu:</strong> ' + event.waktu + '<br>' +
              '<strong>Keterangan:</strong> ' + event.keterangan,
            confirmButtonText: 'OK'
          });
        },
        error: function(xhr, status, error) {
          console.error('Terjadi kesalahan: ' + error);
        }
      });
    }
  });
  return button;
}

$(document).ready(function() {
  let bookings = @json($events);
  let calendarEl = $('#calendar')[0];
  let calendar = new FullCalendar.Calendar(calendarEl, {
    editable: true,
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    events: bookings,
    dateClick: function(date, jsEvent, view) {
      let clickedDate = date.dateStr;
      let url = `{{ route('bidang.event-by-date-bidang') }}`;
      console.log(url);
      $.ajax({
        url: url,
        type: 'GET',
        data: {
          date: clickedDate
        },
        success: function(events) {
          
          $('.table-body-event').empty();
          $('.send-to-wa-button-container').empty();
          if (events.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Tidak Ada Kegiatan',
                text: 'Tidak Ada Kegiatan Pada Tanggal Tersebut',
            })

            $('.table-body-event').html(
              '<tr><td colspan = "5" class = "text-center py-4" > Tidak ada acara! Input Tanggal dan Lihat Jadwal </td> </tr>'
            );
          }
          // Berdasarkan jumlah agenda acara dibuat baris tabel
          $.each(events, function(index, event) {
            let row = $('<tr>').addClass(
              'bg-white border-t border-gray-300 hover:bg-gray-100'
            );
            $('<td>').addClass('px-6 py-4').text(event.title)
              .appendTo(row);
            $('<td>').addClass('px-6 py-4').text(event.tempat)
              .appendTo(row);
            $('<td>').addClass('px-6 py-4').text(event
              .tanggal).appendTo(row);
            $('<td>').addClass('px-6 py-4').text(event
              .waktu).appendTo(row);
            row.append(createDetailButton(event.id));
            $('.table-body-event').append(row);

          });
          // $('.send-to-wa-button-container').append(createSendToWhatsappButton(clickedDate));
          // window.scroll({
          //   top: document.body.scrollHeight,
          //   behavior: 'smooth'
          // });
        },
        error: function(xhr, status, error) {
          alert('Terjadi kesalahan: ' + error);
        }
      });
    }
  });
  calendar.render();
});
</script>
@endsection