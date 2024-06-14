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
                title: 'Edit Ruangan',
                text: '{{ Session::get('success') }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika tombol OK diklik, arahkan ke halaman utama
                    window.location.href = "/admin/ruangan";
                }
            });
        </script>
    @endif
    <main id="main-content" class="bg-gray-100 ml-56 p-4 sm:p-8 md:p-12  lg:p-16 pt-8 min-h-screen">
        <form class="py-4 px-8 bg-white rounded-md shadow-md" action="{{ route('ruangan.update', $ruangan) }}" method="post">
            @csrf
            @method('PUT')
            <h1 class="mb-4  text-4xl text-center font-extrabold leading-none tracking-tight text-blue-500 ">
                Edit Data Ruangan</h1>
            <div class="relative mb-4 w-full">
                <input required type="text" id="floating_title"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    value="{{ $ruangan->nama_ruangan }}" name="nama_ruangan" />
                <label for="floating_title"
                    class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Nama
                    Ruangan
                </label>
            </div>

            <div class="relative mb-4 w-full">
                <input required type="number" id="floating_username"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    value="{{ $ruangan->kapasitas }}" name="kapasitas" />
                <label for="floating_username"
                    class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Kapasitas
                </label>
            </div>
            <div class="relative mb-4 w-full">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select id="countries" name="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Pilih Status Awal Ruangan</option>
                    <option {{ $ruangan->status_ruang == 'tersedia' ? 'selected' : ''}} value="tersedia">Tersedia</option>
                    <option {{ $ruangan->status_ruang == 'tidak tersedia' ? 'selected' : ''}} value="tidak tersedia">Tidak Tersedia</option>
                </select>
            </div>
            <a href="{{ route('ruangan.index') }}"
                class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">Kembali</a>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Tambah</button>
        </form>
    </main>
@endsection
