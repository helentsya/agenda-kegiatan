@extends('layouts.user')

@section('content')
    <main id="main-content" class="bg-gray-100 ml-56 p-4 min-h-screen">
        <h1 class="mb-4 text-2xl leading-none tracking-tight">Agenda {{ $bidang->nama_bidang }}</h1>
        <div id="calendar"></div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Acara</th>
                        <th scope="col" class="px-6 py-3">Tempat</th>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                        <th scope="col" class="px-6 py-3">Waktu</th>
                        <th scope="col" class="px-6 py-3 col-span-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-body-event">
                    <tr>
                        <td colspan="5" class="text-center bg-white py-4">Tidak ada acara! Pilih tanggal Terlebih Dahulu
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="send-to-wa-button-container mt-2"></div>
    </main>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>

    <script>
        function createDetailButton(eventId) {
            let button = $('<button>', {
                text: 'Detail',
                class: 'text-blue-700 mt-2 mr-2 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-1 text-center ',
                click: function() {
                    $.ajax({
                        url: '{{ auth()->user()->id_jabatan == 2 ? route('kepala.event-bidang-detail') : route('pegawai.event-bidang-detail') }}',
                        type: 'GET',
                        data: {
                            id: eventId
                        },
                        success: function(event) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Event Details',
                                html: '<strong>Bidang:</strong> ' + event.bidang +
                                    '<br><strong>Title:</strong> ' + event.title +
                                    '<br><strong>Tempat:</strong> ' + event.tempat +
                                    '<br><strong>Dihadiri:</strong> ' + event.dihadiri +
                                    '<br><strong>Pakaian:</strong> ' + event.pakaian +
                                    '<br><strong>Tanggal:</strong> ' + event.tanggal +
                                    '<br><strong>Waktu:</strong> ' + event.waktu +
                                    '<strong>Keterangan:</strong> ' + event.keterangan +
                                    '<br>' +
                                    '<strong>Yang Diharapkan Hadir:</strong> ' + event
                                    .kapasitas,
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

        function createEditButton(eventId) {
            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'pegawai')
                let button = $('<button>', {
                    text: 'Edit',
                    class: 'text-green-700 mt-2 mr-2 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-1 text-center ',
                    click: function() {
                        window.location.href =
                            `{{ auth()->user()->id_jabatan == 2 ? route('kepala.edit-event-bidang', '') : route('pegawai.edit-event-bidang', '') }}/${eventId}`;
                    }
                });
                return button;
            @endif
        }

        function createDeleteButton(eventId) {
            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'pegawai')
                let button = $('<button>', {
                    text: 'Hapus',
                    class: 'text-red-700 mt-2 mr-2 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center ',
                    click: function() {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Hapus Data',
                            text: 'Apakah Anda Yakin Ingin Menghapus Acara Ini?',
                            showConfirmButton: true,
                            showCancelButton: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: 'DELETE',
                                    url: `{{ auth()->user()->id_jabatan == 2 ? route('kepala.delete-event-bidang') : route('pegawai.delete-event-bidang') }}`,
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        id: eventId,
                                    },
                                    success: function(response) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Data Dihapus',
                                            text: 'Acara telah dihapus.',
                                        }).then(() => {
                                            window.location.href =
                                                `{{ auth()->user()->id_jabatan == 2 ? route('kepala.bidang.agenda', $bidang->id) : route('pegawai.bidang.agenda', $bidang->id) }}`;
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal Menghapus',
                                            text: 'Terjadi kesalahan saat menghapus acara: ' +
                                                error,
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
                return button;
            @endif
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
                    $.ajax({
                        url: '{{ auth()->user()->id_jabatan == 2 ? route('kepala.event-bidang-by-date') : route('pegawai.event-bidang-by-date') }}',
                        type: 'GET',
                        data: {
                            date: clickedDate,
                            id: {{ $bidang->id }},
                        },
                        success: function(events) {
                            $('.table-body-event').empty();
                            $('.send-to-wa-button-container').empty();
                            if (events.length === 0) {
                                $('.table-body-event').html(
                                    '<tr><td colspan="5" class="text-center py-4">Tidak ada acara! Input Tanggal dan Lihat Jadwal</td></tr>'
                                );
                            } else {
                                $.each(events, function(index, event) {
                                    let row = $('<tr>').addClass(
                                        'bg-white border-t border-gray-300 hover:bg-gray-100'
                                    );
                                    $('<td>').addClass('px-6 py-4').text(event
                                        .title).appendTo(row);
                                    $('<td>').addClass('px-6 py-4').text(event
                                        .tempat).appendTo(row);
                                    $('<td>').addClass('px-6 py-4').text(event
                                        .tanggal).appendTo(row);
                                    $('<td>').addClass('px-6 py-4').text(event
                                        .waktu).appendTo(row);
                                    row.append(createDetailButton(event.id));
                                    row.append(createEditButton(event.id));
                                    row.append(createDeleteButton(event.id));
                                    $('.table-body-event').append(row);
                                });
                                $('.send-to-wa-button-container').append(
                                    createSendToWhatsappButton(clickedDate));
                                window.scroll({
                                    top: document.body.scrollHeight,
                                    behavior: 'smooth'
                                });
                            }
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
