@extends('layouts.user')

@section('content')
    @if (Session::has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '{{ Session::get('error')['title'] }}',
                text: '{{ Session::get('error')['message'] }}',
            });
        </script>
    @endif
    @if (Session::has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ Session::get('success')['title'] }}',
                text: '{{ Session::get('success')['message'] }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika tombol OK diklik, arahkan ke halaman utama
                    window.location.href = "/admin/whatsapp";
                }
            });
        </script>
    @endif

    <main id="main-content" class="bg-gray-100 ml-56 p-4 min-h-screen">
        <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8">
            <form class="space-y-6" id="form-whatsapp" action="{{ route('whatsapp.index') }}" method="post">
                @csrf
                <h5 class="text-xl font-medium text-gray-900">Masukkan Nomor Whatsapp</h5>
                <div>
                    <input type="text" name="nomor_telepon" id="nomor_telepon"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Masukkan No.Whatsapp" required>
                </div>
                <div class="flex space-x-4">
                    <button type="submit"
                        class="flex-1 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Simpan</button>
                    <button type="button" onclick="batalSimpan()"
                        class="flex-1 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Batal</button>
                </div>
            </form>
        </div>

        <div class="card-table-events rounded-md border bg-white shadow-lg my-4 p-8">
            <div class="relative overflow-x-auto border border-gray-300 shadow-md sm:rounded-lg mt-4 ">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                No Telepon
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="table-body-event">
                        @foreach ($listNomor as $nomor)
                            <tr class="bg-white border-t border-gray-300 hover:bg-gray-100">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $nomor->nomor_telepon }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('whatsapp.destroy') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="nomor_id" value="{{ $nomor->id }} ">
                                        <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        function batalSimpan() {
            // Clear input jika batal
            $('#nomor_telepon').val('');
        }
    </script>
@endsection
