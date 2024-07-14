@extends('layouts.user')

@section('content')
    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Kelola Ruangan',
                text: '{{ Session::get('success') }}',
            });
        </script>
    @endif
    <main id="main-content" class="bg-gray-100 ml-56 p-4 sm:p-8 md:p-12  lg:p-16 pt-8 min-h-screen">

        <div class="card-table-events rounded-md border bg-white shadow-lg my-4 p-8">
            <div class="flex justify-between">
                <h2 class="font-bold text-xl">Kelola Ruangan</h2>
                @if (auth()->user()->roles == 'admin')
                    <a href="{{ route('ruangan.create') }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah
                        Ruangan</a>
                @endif
            </div>
            <div class="relative overflow-x-auto border border-gray-300 shadow-md sm:rounded-lg mt-4">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama Ruangan</th>
                            <th scope="col" class="px-6 py-3">Kapasitas</th>
                            @if (auth()->user()->roles == 'admin')
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="table-body-event">
                        @forelse ($ruangan as $item)
                            <tr class="bg-white border-t border-gray-300 hover:bg-gray-100">
                                <td class="px-6 py-4">{{ $item->nama_ruangan }}</td>
                                <td class="px-6 py-4">{{ $item->kapasitas }}</td>
                                @if (auth()->user()->roles == 'admin')
                                    <td class="px-6 py-4 flex">
                                        <a href="{{ route('ruangan.edit', $item->id) }}"
                                            class="text-yellow-700 mt-2 mr-2 hover:text-white border border-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-1 text-center">Edit</a>
                                        <form method="POST" action="{{ route('ruangan.destroy', $item->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button
                                                class="text-red-700 mt-2 mr-2 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center">Hapus</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Tidak ada Ruangan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
