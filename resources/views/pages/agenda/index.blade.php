@extends('layouts.user')

@section('content')
    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'List Agenda',
                text: '{{ Session::get('success') }}',
            });
        </script>
    @endif
    <main id="main-content" class="bg-gray-100 ml-56 p-4 sm:p-8 md:p-12 lg:p-16 pt-8 min-h-screen">
        <div class="card-table-events rounded-md border bg-white shadow-lg my-4 p-8">
            <div class="flex justify-between">
                <h2 class="font-bold text-xl">Daftar Agenda</h2>
                {{-- Form Pencarian --}}
                @if (auth()->user()->id_jabatan == 1)
                    <form method="GET" action="{{ route('agenda.index') }}" class="flex items-center">
                    @elseif (auth()->user()->id_jabatan == 2)
                        <form method="GET" action="{{ route('kepala.agenda.index') }}" class="flex items-center">
                        @else
                            <form method="GET" action="{{ route('pegawai.agenda.index') }}" class="flex items-center">
                @endif
                <input type="text" name="search" placeholder="Cari Agenda..." class="border rounded p-2"
                    value="{{ request('search') }}">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-2">
                    Cari
                </button>
                </form>
            </div>
            @if (auth()->user()->roles === 'admin' || auth()->user()->roles === 'pegawai')
                <a href="{{ auth()->user()->roles === 'admin' ? route('store-event') : route('pegawai.store-event') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah
                    Agenda</a>
            @endif
            <div class="relative overflow-x-auto border border-gray-300 shadow-md sm:rounded-lg mt-4">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Acara</th>
                            <th scope="col" class="px-6 py-3">Bidang</th>
                            <th scope="col" class="px-6 py-3">Tempat</th>
                            <th scope="col" class="px-6 py-3">Pakaian</th>
                            <th scope="col" class="px-6 py-3">Dihadiri</th>
                            <th scope="col" class="px-6 py-3">Yang Diharapkan Berhadir</th>
                            <th scope="col" class="px-6 py-3">Tanggal Mulai</th>
                            <th scope="col" class="px-6 py-3">Tanggal Berakhir</th>
                            <th scope="col" class="px-6 py-3 col-span-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-body-event">
                        @foreach ($agenda as $event)
                            <tr class="bg-white border-t border-gray-300 hover:bg-gray-100">
                                <td class="px-6 py-4">{{ $event->title }}</td>
                                <td class="px-6 py-4">{{ $event->bidang->nama_bidang }}</td>
                                <td class="px-6 py-4">{{ $event->ruangan->nama_ruangan }}</td>
                                <td class="px-6 py-4">{{ $event->pakaian }}</td>
                                <td class="px-6 py-4">{{ $event->dihadiri }}</td>
                                <td class="px-6 py-4">{{ $event->kapasitas }} Orang</td>
                                <td class="px-6 py-4">{{ $event->start_event }}</td>
                                <td class="px-6 py-4">{{ $event->end_event }}</td>
                                <td>
                                    @if (auth()->user()->roles === 'admin' || auth()->user()->roles === 'pegawai')
                                        <a href="{{ auth()->user()->roles === 'admin' ? route('show-edit-event-bidang', $event->id) : route('pegawai.show-edit-event-bidang', $event->id) }}"
                                            class="text-yellow-700 mt-2 mr-2 hover:text-white border border-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-1 text-center">Edit</a>
                                        <form
                                            action="{{ auth()->user()->roles === 'admin' ? route('delete-agenda', $event->id) : route('pegawai.delete-agenda', $event->id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-700 mt-2 mr-2 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $agenda->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </main>
@endsection
