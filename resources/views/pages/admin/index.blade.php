@extends('layouts.user')

@section('content')
    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Tambah Pegawai',
                text: '{{ Session::get('success') }}',
            });
        </script>
    @endif
    <main id="main-content" class="bg-gray-100 ml-56 p-4 sm:p-8 md:p-12  lg:p-16 pt-8 min-h-screen">

        <div class="card-table-events rounded-md border  bg-white shadow-lg my-4 p-8">
            <div class="flex justify-between">
                <h2 class="font-bold text-xl">Kelola Pegawai</h2>
                <a href="{{ route('admin.create') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah
                    Pegawai</a>
            </div>
            <div class="relative overflow-x-auto border border-gray-300 shadow-md sm:rounded-lg mt-4 ">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr class>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nip
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Bidang
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Username
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Roles
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-body-event">
                        @forelse ($pegawai as $item)
                            <tr class="bg-white border-t border-gray-300 hover:bg-gray-100">
                                <td class="px-6 py-4">{{ $item->nama_pegawai }}</td>
                                <td class="px-6 py-4">{{ $item->nip }}</td>
                                <td class="px-6 py-4">{{ $item->bidang->nama_bidang }}</td>
                                {{-- <td class="px-6 py-4"><span class="badge bg-primary">{{ $item->roles }}</td> --}}
                                <td>{{ $item->user->username }}</td>
                                <td>{{ $item->user->roles }}</td>
                                <td class="px-6 py-4">


                                    <form method="POST" action="{{ route('kelola-pegawai.destroy', $item->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button
                                            class="text-red-700 mt-2 mr-2 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center ">Hapus</button>
                                    </form>

                                </td>
                                <td>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">Tidak ada Pegawai
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
