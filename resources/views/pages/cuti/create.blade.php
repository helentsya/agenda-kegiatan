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
                title: 'Pengajuan Cuti Pegawai',
                text: '{{ Session::get('success') }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika tombol OK diklik, arahkan ke halaman utama
                    window.location.href = "/pegawai";
                }
            });
        </script>
    @endif
    <main id="main-content" class="bg-gray-100 ml-56 p-4 sm:p-8 md:p-12  lg:p-16 pt-8 min-h-screen">
        <form class="py-4 px-8 bg-white rounded-md shadow-md"
            action="{{ auth()->user()->roles == 'admin' ? route('cuti.store') : route('pegawai.cuti.store') }}"
            method="post">
            @csrf
            <h1 class="mb-4  text-4xl text-center font-extrabold leading-none tracking-tight text-blue-500 ">
                Pengajuan Cuti Pegawai</h1>
            <div class="relative mb-4 w-full">
                <input required type="text" id="floating_title"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-gray-200 rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="{{ auth()->user()->pegawai->nama_pegawai }}" name="name" disabled />
            </div>
            <div class="relative mb-4 w-full">
                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <select id="countries" name="jenis_cuti" @error('jenis_cuti') is-invalid @enderror
                    class="bg-gray-50
                    border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block
                    w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white
                    dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected disabled>Pilih Jenis Cuti</option>
                    <option value="cuti tahunan">Cuti Tahunan (max 12 hari)</option>
                    <option value="cuti besar">Cuti Besar (max 30 hari)</option>
                    <option value="cuti sakit">Cuti Sakit (max 10 hari)</option>
                    <option value="cuti melahirkan">Cuti Melahirkan (max 90 hari)</option>
                </select>
                @error('jenis_cuti')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="relative mb-4 w-full">
                <input required type="date" id="floating_awal_cuti" @error('mulai_cuti') is-invalid @enderror"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " name="mulai_cuti" />
                @error('mulai_cuti')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="floating_awal_cuti"
                    class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Awal
                    Cuti
                </label>
            </div>

            <div class="relative mb-4 w-full">
                <input required type="date" id="floating_akhir_cuti" @error('akhir_cuti') is-invalid @enderror"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " name="akhir_cuti" />
                @error('akhir_cuti')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="floating_akhir_cuti"
                    class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Akhir
                    Cuti
                </label>
            </div>

            <div class="relative mb-4 w-full">
                <input required type="text" id="floating_alasan" @error('alasan') is-invalid @enderror"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder=" " name="alasan" />
                @error('alasan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="floating_alasan"
                    class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Alasan
                    Cuti
                </label>
            </div>
            @if (auth()->user()->roles == 'admin')
                <a href="{{ route('pegawai.home') }}"
                    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">Kembali</a>
            @else
                <a href="{{ route('pegawai.pegawai.home') }}"
                    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">Kembali</a>
            @endif
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">Ajukan</button>

        </form>
    </main>
@endsection
