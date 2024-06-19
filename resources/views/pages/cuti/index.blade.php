@extends('layouts.user')

@section('content')
    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Cuti Pegawai',
                text: '{{ Session::get('success') }}',
            });
        </script>
    @endif
    @if (Session::has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ Session::get('error') }}',
            });
        </script>
    @endif
    <main id="main-content" class="bg-gray-100 ml-56 p-4 sm:p-8 md:p-12  lg:p-16 pt-8 min-h-screen">

        <div class="card-table-events rounded-md border  bg-white shadow-lg my-4 p-8">
            <div class="flex justify-between">
                <h2 class="font-bold text-xl">Kelola Cuti Pegawai</h2>
                @if (!Auth::user()->roles != 'kepala pejabat')
                    <a href="{{ route('pegawai.cuti.create') }}"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah
                        Cuti</a>
                @endif
            </div>
            <div class="relative overflow-x-auto border border-gray-300 shadow-md sm:rounded-lg mt-4 ">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr class>
                            <th scope="col" class="px-6 py-3">
                                Nama Pegawai
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Tanggal Cuti
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Durasi Cuti
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Alasan
                            </th>
                            @if (auth()->user()->roles == 'admin' || auth()->user()->roles == 'kepalapejabat')
                                <th scope="col" class="px-6 py-3">
                                    Aksi
                                </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="table-body-event">
                        @forelse ($cuti as $item)
                            <tr class="bg-white border-t border-gray-300 hover:bg-gray-100">
                                <td class="px-6 py-4">{{ $item->pegawai->nama_pegawai }}</td>
                                <td class="px-6 py-4"><span class="badge bg-primary">{{ $item->mulai_cuti }}</td>
                                <td class="px-6 py-4">{{ $item->lama_cuti }}</td>
                                <td class="px-6 py-4">{{ $item->keterangan }}</td>
                                @if (auth()->user()->roles == 'admin' || auth()->user()->roles == 'kepalapejabat')
                                    <td class="px-6 py-4">
                                        @if ($item->is_approved == 1)
                                            <span class="badge bg-green-500 rounded-full py-2 px-2 text-white">Telah
                                                Disetujui</span>
                                        @else
                                            @if (auth()->user()->roles == 'admin')
                                                <form method="POST" action="{{ route('cuti.update', $item->id) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <button
                                                        class="text-green-700 mt-2 mr-2 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-1 text-center ">Setujui</button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('kepala.cuti.update', $item->id) }}">
                                                    @method('PUT')
                                                    @csrf
                                                    <button
                                                        class="text-green-700 mt-2 mr-2 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-2 py-1 text-center ">Setujui</button>
                                                </form>
                                            @endif
                                        @endif
                                    </td>
                                @endif

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">Tidak ada Cuti
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
