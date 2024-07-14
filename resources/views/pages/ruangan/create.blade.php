@extends('layouts.user')

@section('content')
    @if (Session::has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ Session::get('error') }}',
            });
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Tambah Ruangan',
                text: '{{ Session::get('success') }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/admin/ruangan";
                }
            });
        </script>
    @endif
    <main id="main-content" class="bg-gray-100 ml-56 p-4 sm:p-8 md:p-12 lg:p-16 pt-8 min-h-screen">
        <form class="py-4 px-8 bg-white rounded-md shadow-md" action="{{ route('ruangan.store') }}" method="post">
            @csrf
            <h1 class="mb-4 text-4xl text-center font-extrabold leading-none tracking-tight text-blue-500">Tambah Ruangan
                Baru</h1>

            <div class="relative mb-4 w-full">
                <input required type="text" id="nama_ruangan"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " name="nama_ruangan" />
                <label for="nama_ruangan"
                    class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-2 z-10 bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75">Nama
                    Ruangan</label>
            </div>

            <div class="relative mb-4 w-full">
                <input required type="number" id="kapasitas"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " name="kapasitas" />
                <label for="kapasitas"
                    class="absolute text-sm text-gray-500 transform -translate-y-4 scale-75 top-2 z-10 bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75">Kapasitas</label>
            </div>
            <a href="{{ route('ruangan.index') }}"
                class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-200">Kembali</a>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Tambah</button>
        </form>
    </main>
@endsection
