@php
    $bidang = App\Models\Bidang::all();
@endphp
<aside id="sidebar" class="bg-[#343a40] w-56 h-screen  fixed top-0 duration-100 ease-in-out z-40">
    <ul class="w-full h-full ">
        <li class="">
            <a class="flex px-6 py-2" href="/">
                <img src="{{ asset('/images/logo-dinas.png') }}" class="w-12 mr-2" alt="">
                <h1 class="text-xl text-white ">Agenda Kegiatan</h1>
            </a>
        </li>


        @if (Auth::user()->roles == 'admin')
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                    href="{{ route('store-event') }}">
                    <svg class="w-[16px] h-[16px] mr-2 fill-white text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M9 1v16M1 9h16" />
                    </svg>
                    <span class="text-sm text-white">Tambah Jadwal Baru</span>
                </a>
            </li>
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]" href="#">
                    <svg class="w-[16px] h-[16px] mr-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                        <path
                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="text-sm text-white">Agenda</span>
                </a>
            </li>
            @foreach ($bidang as $b)
                <li class="px-2 pl-5">
                    <a class="flex pl-5 ml-2 rounded-md py-2 content-center hover:bg-[#5c6268]"
                        href="{{ route('bidang.agenda', $b->id) }}">
                        <span class="text-sm text-white">{{ $b->nama_bidang }}</span>
                    </a>
                </li>
            @endforeach
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                    href="{{ route('show-print-pdf') }}">
                    <svg class="w-[16px] h-[16px] mr-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                        <path
                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="text-sm text-white">Unduh PDF</span>
                </a>
            </li>
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                    href="{{ route('whatsapp.index') }}">
                    <svg class="mr-2 fill-white" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" height="16px" width="16px"
                        version="1.1" id="Layer_1" viewBox="0 0 308 308" xml:space="preserve">
                        <g id="XMLID_468_">
                            <path id="XMLID_469_"
                                d="M227.904,176.981c-0.6-0.288-23.054-11.345-27.044-12.781c-1.629-0.585-3.374-1.156-5.23-1.156   c-3.032,0-5.579,1.511-7.563,4.479c-2.243,3.334-9.033,11.271-11.131,13.642c-0.274,0.313-0.648,0.687-0.872,0.687   c-0.201,0-3.676-1.431-4.728-1.888c-24.087-10.463-42.37-35.624-44.877-39.867c-0.358-0.61-0.373-0.887-0.376-0.887   c0.088-0.323,0.898-1.135,1.316-1.554c1.223-1.21,2.548-2.805,3.83-4.348c0.607-0.731,1.215-1.463,1.812-2.153   c1.86-2.164,2.688-3.844,3.648-5.79l0.503-1.011c2.344-4.657,0.342-8.587-0.305-9.856c-0.531-1.062-10.012-23.944-11.02-26.348   c-2.424-5.801-5.627-8.502-10.078-8.502c-0.413,0,0,0-1.732,0.073c-2.109,0.089-13.594,1.601-18.672,4.802   c-5.385,3.395-14.495,14.217-14.495,33.249c0,17.129,10.87,33.302,15.537,39.453c0.116,0.155,0.329,0.47,0.638,0.922   c17.873,26.102,40.154,45.446,62.741,54.469c21.745,8.686,32.042,9.69,37.896,9.69c0.001,0,0.001,0,0.001,0   c2.46,0,4.429-0.193,6.166-0.364l1.102-0.105c7.512-0.666,24.02-9.22,27.775-19.655c2.958-8.219,3.738-17.199,1.77-20.458   C233.168,179.508,230.845,178.393,227.904,176.981z" />
                            <path id="XMLID_470_"
                                d="M156.734,0C73.318,0,5.454,67.354,5.454,150.143c0,26.777,7.166,52.988,20.741,75.928L0.212,302.716   c-0.484,1.429-0.124,3.009,0.933,4.085C1.908,307.58,2.943,308,4,308c0.405,0,0.813-0.061,1.211-0.188l79.92-25.396   c21.87,11.685,46.588,17.853,71.604,17.853C240.143,300.27,308,232.923,308,150.143C308,67.354,240.143,0,156.734,0z    M156.734,268.994c-23.539,0-46.338-6.797-65.936-19.657c-0.659-0.433-1.424-0.655-2.194-0.655c-0.407,0-0.815,0.062-1.212,0.188   l-40.035,12.726l12.924-38.129c0.418-1.234,0.209-2.595-0.561-3.647c-14.924-20.392-22.813-44.485-22.813-69.677   c0-65.543,53.754-118.867,119.826-118.867c66.064,0,119.812,53.324,119.812,118.867   C276.546,215.678,222.799,268.994,156.734,268.994z" />
                        </g>
                    </svg>
                    <span class="text-sm text-white">Kirim ke Whatsapp</span>
                </a>
            </li>
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                    href="{{ route('kelola-pegawai.index') }}">
                    <svg class="w-[16px] h-[16px] mr-2 fill-white text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M9 1v16M1 9h16" />
                    </svg>
                    <span class="text-sm text-white">Kelola Pegawai</span>
                </a>
            </li>
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]" href="{{ route('cuti.index') }}">
                    <svg class="w-[16px] h-[16px] mr-2 fill-white text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M9 1v16M1 9h16" />
                    </svg>
                    <span class="text-sm text-white">Kelola Cuti</span>
                </a>
            </li>
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                    href="{{ route('ruangan.index') }}">
                    <svg class="w-[16px] h-[16px] mr-2 fill-white text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M9 1v16M1 9h16" />
                    </svg>
                    <span class="text-sm text-white">Kelola RUangan</span>
                </a>
            </li>
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                    href="{{ route('pengumuman.index') }}">
                    <svg class="w-[16px] h-[16px] mr-2 fill-white text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M9 1v16M1 9h16" />
                    </svg>
                    <span class="text-sm text-white">Kelola Pengumuman</span>
                </a>
            </li>
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                    href="{{ route('profile.edit') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#FFFFFF">
                        <path
                            d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                    </svg>
                    <span class="text-sm text-white">Edit Profile</span>
                </a>
            </li>
        @elseif(Auth::user()->roles == 'pegawai')
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                    href="{{ route('pegawai.store-event') }}">
                    <svg class="w-[16px] h-[16px] mr-2 fill-white text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M9 1v16M1 9h16" />
                    </svg>
                    <span class="text-sm text-white">Tambah Jadwal Baru</span>
                </a>
            </li>
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]" href="#">
                    <svg class="w-[16px] h-[16px] mr-2 text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                        <path
                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="text-sm text-white">Agenda</span>
                </a>
            </li>
            @foreach ($bidang as $b)
                <li class="px-2 pl-5">
                    <a class="flex pl-5 ml-2 rounded-md py-2 content-center hover:bg-[#5c6268]"
                        href="{{ route('pegawai.bidang.agenda', $b->id) }}">
                        <span class="text-sm text-white">{{ $b->nama_bidang }}</span>
                    </a>
                </li>
            @endforeach
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                    href="{{ route('pegawai.ruangan.index') }}">
                    <svg class="w-[16px] h-[16px] mr-2 fill-white text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M9 1v16M1 9h16" />
                    </svg>
                    <span class="text-sm text-white">Data Ruangan</span>
                </a>
            </li>
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                    href="{{ route('pegawai.cuti.index') }}">
                    <svg class="w-[16px] h-[16px] mr-2 fill-white text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M9 1v16M1 9h16" />
                    </svg>
                    <span class="text-sm text-white">Ajukan Cuti</span>
                </a>
            </li>
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                    href="{{ route('pegawai.kelola-pegawai.index') }}">
                    <svg class="w-[16px] h-[16px] mr-2 fill-white text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M9 1v16M1 9h16" />
                    </svg>
                    <span class="text-sm text-white">Kelola Pegawai</span>
                </a>
            </li>
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                    href="{{ route('profile.edit') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#FFFFFF">
                        <path
                            d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                    </svg>
                    <span class="text-sm text-white">Edit Profile</span>
                </a>
            </li>
        @elseif (Auth::user()->roles == 'kepalapejabat')
            <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]">
                    <svg class="w-[16px] h-[16px] mr-2 text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                        <path
                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="text-sm text-white">Lihat Agenda</span>
                </a>
                @foreach ($bidang as $b)
            <li class="px-2 pl-5">
                <a class="flex pl-5 ml-2 rounded-md py-2 content-center hover:bg-[#5c6268]"
                    href="{{ route('kepala.bidang.agenda', $b->id) }}">
                    <span class="text-sm text-white">{{ $b->nama_bidang }}</span>
                </a>
            </li>
        @endforeach
        </li>
        <li class="px-2">
            <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                href="{{ route('kepala.ruangan.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#FFFFFF">
                    <path
                        d="M120-120v-560h240v-80l120-120 120 120v240h240v400H120Zm80-80h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm240 320h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm0-160h80v-80h-80v80Zm240 480h80v-80h-80v80Zm0-160h80v-80h-80v80Z" />
                </svg>
                <span class="text-sm text-white">Data Ruangan</span>
            </a>
        </li>
        <li class="px-2">
            <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                href="{{ route('kepala.cuti.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#FFFFFF">
                    <path
                        d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
                </svg>
                <span class="text-sm text-white">Lihat Cuti</span>
            </a>
        </li>
        <li class="px-2">
            <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                href="{{ route('kepala.kelola-pegawai.index') }}">
                <svg class="w-[16px] h-[16px] mr-2 fill-white text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                        d="M9 1v16M1 9h16" />
                </svg>
                <span class="text-sm text-white">Kelola Pegawai</span>
            </a>
        </li>
        <li class="px-2">
            <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                href="{{ route('profile.edit') }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#FFFFFF">
                    <path
                        d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                </svg>
                <span class="text-sm text-white">Edit Profile</span>
            </a>
        </li>
    @elseif (Auth::user()->roles == 'bidang')
        <li class="px-2">
            <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]" href="#">
                <svg class="w-[16px] h-[16px] mr-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                    <path
                        d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                </svg>
                <span class="text-sm text-white">Agenda</span>
            </a>
        </li>
        @foreach ($bidang as $b)
            @if (Auth::user()->pegawai->id_bidang == $b->id)
                <li class="px-2 pl-5">
                    <a class="flex pl-5 ml-2 rounded-md py-2 content-center hover:bg-[#5c6268]"
                        href="{{ route('bidang.index') }}">
                        <span class="text-sm text-white">{{ $b->nama_bidang }}</span>
                    </a>
                </li>
            @endif
        @endforeach
        <li class="px-2">
            <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                href="{{ route('bidang.cuti.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                    fill="#FFFFFF">
                    <path
                        d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
                </svg>
                <span class="text-sm text-white">Cuti</span>
            </a>
        </li>
        {{-- <li class="px-2">
                <a class="flex pl-4 rounded-md py-2 content-center hover:bg-[#5c6268]"
                    href="{{ route('profile.edit') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#FFFFFF">
                        <path
                            d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z" />
                    </svg>
                    <span class="text-sm text-white">Edit Profile</span>
                </a>
            </li> --}}

        @endif
    </ul>
</aside>
