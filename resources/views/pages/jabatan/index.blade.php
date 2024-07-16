@extends('layouts.user')

@section('content')
    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Kelola Jabatan',
                text: '{{ Session::get('success') }}',
            });
        </script>
    @endif
    <main id="main-content" class="bg-gray-100 ml-56 p-4 sm:p-8 md:p-12 lg:p-16 pt-8 min-h-screen">
        <div class="card-table-events rounded-md border bg-white shadow-lg my-4 p-8">
            <div class="flex justify-between">
                <h2 class="font-bold text-xl">Kelola Jabatan</h2>
                <a href="{{ route('jabatans.create') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create
                    Jabatan</a>
            </div>
            <div class="relative overflow-x-auto border border-gray-300 shadow-md sm:rounded-lg mt-4 ">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Nama Jabatan</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-body-event">
                        @foreach ($jabatans as $jabatan)
                            <tr class="bg-white border-t border-gray-300 hover:bg-gray-100">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $jabatan->nama_jabatan }}</td>
                                <td>
                                    <a href="{{ route('jabatans.edit', $jabatan->id_jabatan) }}"
                                        class="text-yellow-700 mt-2 mr-2 hover:text-white border border-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-2 py-1 text-center">Edit</a>
                                    <form action="{{ route('jabatans.destroy', $jabatan->id_jabatan) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-700 mt-2 mr-2 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2 py-1 text-center">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $jabatans->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </main>
@endsection
