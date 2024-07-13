@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="/logopemko.png">
    <!-- Required meta tags -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>Dinas Komunikasi dan Informatika Kota Banjarbaru</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nivo-lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_sideslide.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script> --}}

    <link rel="shortcut icon" href="http://diskominfo.banjarbarukota.go.id/oriz/favicon.ico">
</head>
<style>
    .custom-table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        border-radius: 8px;
    }

    .custom-table th,
    .custom-table td {
        padding: 15px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .custom-table th {
        background-color: #4CAF50;
        color: white;
        font-weight: bold;
        text-transform: uppercase;
    }

    .custom-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .custom-table tr:hover {
        background-color: #e0e0e0;
    }

    .section-header h2 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    .card-table-events {
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .card-table-events h2 {
        font-size: 1.8rem;
        font-weight: bold;
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }
</style>

<body>
    <div class="menu-wrap">
        <nav class="menu navbar">
            <div class="icon-list navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#video-area">Home</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#services">Pelayanan Kami</a>
                    </li> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#blog">Kabar Terbaru</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Agenda Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#literasi">Literasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pengumuman">Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#ruangan">Ruangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#subscribe">Hubungi Kami</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="fa fa-sign-in"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <button class="close-button" id="close-button"><i class="lnr lnr-cross"></i></button>
    </div>
    <!-- Header Section Start -->

    <header id="video-area" data-stellar-background-ratio="0.5">
        <div id="block" data-vide-bg="/video/backgroundd"></div>
        <div class="fixed-top">
            <div class="container">
                <div class="logo-menu">
                    <a href="/"> <img src="/img/logo-white.png" height=50px></a>
                    <button class="menu-button" id="open-button"><i class="lnr lnr-menu"></i></button>
                </div>
            </div>
        </div>
        <div class="overlay overlay-2"></div>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-10">
                    <div class="contents text-center">
                        <h1 class="wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">Sistem Informasi
                            Agenda</h1>
                        <h1 class="wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">Dinas Komunikasi dan
                            Informatika<br />Kota Banjarbaru</h1>
                        <p class="lead  wow fadeIn" data-wow-duration="1000ms" data-wow-delay="400ms">Mari Bersama
                            Wujudkan <b>#BANJARBARUJUARA</b></p>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->


    <!-- Services Section Start -->
    {{-- <section id="services" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Pelayanan <span>
                        Kami</span></h2>
                <hr class="lines wow zoomIn" data-wow-delay="0.3s">

            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.2s"><a
                            href="https://kim.banjarbarukota.go.id/">
                            <div class="icon">
                                <i class="lnr lnr-pencil"></i>
                            </div>
                            <h4>Kelompok Informasi Masyarakat (KIM)</h4>
                            <p>lembaga layanan publik yang dibentuk dan dikelola dari, oleh dan untuk masyarakat</p>
                        </a></div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.4s"><a
                            href="https://siapweb.banjarbarukota.go.id">
                            <div class="icon">
                                <i class="lnr lnr-cog"></i>
                            </div>
                            <h4>Web Development</h4>
                            <p>Pengaturan subdomain, email SKPD, website SKPD dan Pengelolaan Website Kota Banjarbaru
                            </p>
                        </a></div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.6s">
                        <div class="icon">
                            <i class="lnr lnr-cloud-upload"></i>
                        </div>
                        <h4>Network Development</h4>
                        <p>Sebagai troubleshooting jaringan di seluruh SKPD Kota Banjarbaru</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.8s">
                        <a href="http://ppid.banjarbarukota.go.id/">
                            <div class="icon">
                                <i class="lnr lnr-layers"></i>
                            </div>
                            <h4>PPID</h4>
                            <p>Layanan informasi publik sebagai cara baru yang lebih praktis untuk dapat informasi</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="1s">
                        <a href="http://lapor.go.id/">
                            <div class="icon">
                                <i class="lnr lnr-tablet"></i>
                            </div>
                            <h4>LAPOR</h4>
                            <p>Aplikasi LAPOR terkait kinerja pelayanan publik Kota Banjarbaru,melalui website atau
                                kirim SMS ke 1708 dengan format: BANJARBARU(spasi)isi keluhan.</p>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="1.2s">
                        <a href="http://lpse.banjarbarukota.go.id/">
                            <div class="icon">
                                <i class="lnr lnr-briefcase"></i>
                            </div>
                            <h4>LPSE</h4>
                            <p>Layanan Pengadaan Secara Elektronik</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Services Section End -->

    <!-- Features Section Start -->

    <!-- Features Section End -->

    <!-- Start Video promo Section -->

    <!-- End Video Promo Section -->

    <!-- Portfolio Section -->

    <!-- Portfolio Controller/Buttons Ends-->

    <!-- Portfolio Recent Projects -->

    <!-- Container Ends -->

    <!-- Portfolio Section Ends -->

    <!-- Start Pricing Table Section -->

    <!-- End Pricing Table Section -->

    <!-- Counter Section Start -->

    <!-- Counter Section End -->

    <!-- testimonial Section Start -->

    <!-- testimonial Section Start -->

    <!-- Download Section Start -->

    <!-- Download Section End -->

    <!-- Blog Section -->
    <section id="blog" class="section">
        <!-- Container Starts -->


    </section>

    <section id="bjbtv" class="section">
        <!-- Container Starts -->


    </section>


    <!-- blog Section End -->

    <!-- Features Section Start -->
    <section id="features" class="section" data-stellar-background-ratio="0.2">
        <div class="container">
            <div class="section-header">
                <br>
                <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Agenda
                    <span>Kami</span>
                </h2>
                <hr class="lines wow zoomIn" data-wow-delay="0.3s">
                <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s"> </p>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card-table-events rounded-md border bg-white shadow-lg my-4 p-8">
                        <h2 class="font-bold text-2xl text-center mb-4">Agenda Hari Ini</h2>
                        <div class="overflow-x-auto">
                            <table class="custom-table">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Tempat</th>
                                        <th>Kegiatan</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($events as $event)
                                        @php
                                            $startDate = Carbon::parse($event->start_event)->format('d M Y');
                                            $startTime = Carbon::parse($event->start_event)->format('H:i');
                                        @endphp
                                        <tr>
                                            <td>{{ $startDate }}</td>
                                            <td>{{ $startTime }}</td>
                                            <td>{{ $event->ruangan->nama_ruangan }}</td>
                                            <td>{{ $event->title }}</td>
                                            <td>{{ $event->keterangan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="pengumuman" class="section" data-stellar-background-ratio="0.2">
        <div class="container">
            <div class="section-header">
                <br>
                <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Pengumuman
                    Terbaru</h2>
                <hr class="lines wow zoomIn" data-wow-delay="0.3s">
            </div>
            <div class="row">
                @foreach ($pengumuman as $item)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb-4">
                        <div class="pengumuman-box show-box wow fadeInDown animated" data-wow-offset="10"
                            style="padding: 10px;">
                            <img src="/images/diskominfo.jpg" style="width: 100%;" alt="">
                            <h4>{{ $item->judul_pengumuman }}</h4>
                            <p>{{ $item->isi_pengumuman }}</p>
                            <small>{{ $item->tanggal_pengumuman }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section id="ruangan" class="section" data-stellar-background-ratio="0.2">
        <div class="container">
            <div class="section-header">
                <br>
                <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Ruangan Kami
                </h2>
                <hr class="lines wow zoomIn" data-wow-delay="0.3s">
            </div>
            <div class="row">
                @foreach ($ruangan as $room)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="ruangan-box show-box wow fadeInDown animated" data-wow-offset="10">
                            <img src="/images/building.svg" style="width: 100%;" alt="">
                            <h4 class="text-center">{{ $room->nama_ruangan }}</h4>
                            <p>Kapasitas: {{ $room->kapasitas }}</p>
                            <p>Status: {{ $room->status_ruang }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features Section End -->

    <!-- Modal -->
    {{-- <div class="modal fade" id="agendaModal" tabindex="-1" role="dialog" aria-labelledby="agendaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agendaModalLabel">Agenda Bidang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" id="agendaTable">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Dihadiri</th>
                                <th>Pakaian</th>
                                <th>Keterangan</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan dimuat di sini dengan JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Contact Section Start -->

    {{-- <section id="literasi" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Literasi <span>
                        Digital</span></h2>
                <hr class="lines wow zoomIn" data-wow-delay="0.3s">

            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.2s"><a
                            href="https://cloud.banjarbarukota.go.id/index.php/s/R5KLXtpsmaCqkgY">
                            <div class="icon">
                                <i class="lnr lnr-pencil"></i>
                            </div>
                            <h4>Buku Saku Dunia Cyber</h4>
                            <p>Beradaptasi Dengan Dunia Cyber di Generasi New Normal</p>
                        </a></div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.4s"><a
                            href="https://bssn.go.id/wp-content/uploads/2019/05/Buku-Tips-BSSN-2019-tte.pdf">
                            <div class="icon">
                                <i class="lnr lnr-cog"></i>
                            </div>
                            <h4>Tips Singkat Dunia Cyber</h4>
                            <p>Dari BSSN Untuk Masyarakat</p>
                        </a></div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="item-boxes wow fadeInDown" data-wow-delay="0.6s"><a
                            href="https://cloud.bssn.go.id/s/WrczsGWHKjpdPea#pdfviewer">
                            <div class="icon">
                                <i class="lnr lnr-cloud-upload"></i>
                            </div>
                            <h4>Penanganan Insiden Web Defacement</h4>
                            <p>Prosedur yang standar untuk melakukan penanganan terhadap insiden Web Defacement</p>
                        </a>
                    </div>
                </div>



            </div>
        </div>
    </section> --}}



    <!-- Contact Section End -->

    <!-- Subcribe Section Start -->
    <div id="subscribe" class="section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Hubungi
                    <span>Kami</span>
                </h2>
                <hr class="lines wow zoomIn" data-wow-delay="0.3s">
                <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s"><br>Gedung
                    Diskominfo Banjarbaru
                    Jl. Pangeran Suriansyah No.5
                    Kel. Komet, Kec. Banjarbaru Utara
                    Kota Banjarbaru,70711
                    Kalimantan Selatan
                    <br>
                    <iframe class="peta"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1991.3136337786625!2d114.83136665800139!3d-3.4405078993739555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de681734efdb983%3A0x7e6f28c7241fe75b!2sDiskominfo+Banjarbaru!5e0!3m2!1sen!2sid!4v1538619150542"
                        width="900" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <br>
                    Email: diskominfo@banjarbarukota.go.id<br>
                    Helpdesk: 0811-5287-070 (WA Chat Only)<br>
                    Kontak Kami: 0811-5289-090 (WA Chat Only)
                </p>

            </div>
        </div>
    </div>
    <!-- Subcribe Section End -->

    <!-- Footer Section Start -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="social-icons wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s">
                        <ul>
                            <li class="facebook"><a href="https://www.facebook.com/DiskominfoBanjarbaru/"><i
                                        class="fa fa-facebook"></i></a></li>
                            <li class="twitter"><a href="https://twitter.com/Diskominfo_Bjb"><i
                                        class="fa fa-twitter"></i></a></li>
                            <li class="youtube"><a
                                    href="https://www.youtube.com/channel/UCJVuO7c7t5vf7MqJqYzM_ig?view_as=subscriber"><i
                                        class="fa fa-youtube"></i></a></li>
                            <li class="instagram"><a href="https://www.instagram.com/diskominfobjb/"><i
                                        class="fa fa-instagram"></i></a></li>

                        </ul>
                    </div>
                    <div class="site-info wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="0.3s">
                        <p>All copyrights reserved &copy; 2018 - Designed & Developed by <a rel="nofollow"
                                href="https://ikaptk.or.id/">IKAPTK</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Go To Top Link -->
    <a href="#" class="back-to-top">
        <i class="lnr lnr-arrow-up"></i>
    </a>

    <div id="loader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <!-- Menggunakan fungsi asset untuk referensi JS -->
    <script src="{{ asset('js/jquery-min.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/classie.js') }}"></script>
    <script src="{{ asset('js/mixitup.min.js') }}"></script>
    <script src="{{ asset('js/nivo-lightbox.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nav.js') }}"></script>
    <script src="{{ asset('js/smooth-scroll.js') }}"></script>
    <script src="{{ asset('js/smooth-on-scroll.js') }}"></script>
    <script src="{{ asset('js/wow.js') }}"></script>
    <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/jquery.vide.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/form-validator.min.js') }}"></script>
    <script src="{{ asset('js/contact-form-script.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>


    <script>
        $(document).ready(function() {
            //feed to parse
            var feed = "https://diskominfo.banjarbarukota.go.id/feed/";


            $.ajax(feed, {
                accepts: {
                    xml: "application/rss+xml"
                },
                dataType: "xml",
                success: function(data) {
                    //Credit: http://stackoverflow.com/questions/10943544/how-to-parse-an-rss-feed-using-javascript
                    var blog = $("#blog");
                    var newcode = "";
                    newcode += '<div class="container">';
                    newcode += '<div class="section-header">';
                    newcode +=
                        '<h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Kabar <span>Terbaru</span></h2>';
                    newcode += '<hr class="lines wow zoomIn" data-wow-delay="0.3s">';
                    newcode += '</div>';
                    newcode += '<div class="row">';
                    $(data).find("item").each(function() { // or "item" or whatever suits your feed
                        var el = $(this);
                        //var desc = el.find("description");
                        // var gambar = desc.find("img").src();
                        var d = new Date(el.find("pubDate").text());
                        //d = d.slice(0, 15);

                        newcode +=
                            '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 blog-item">';
                        newcode +=
                            '<div class="blog-item-wrapper wow fadeInUp" data-wow-delay="0.3s">';
                        newcode += '<div class="blog-item-img">';
                        newcode += '<a href="single-post.html">';
                        newcode += '<img src="" alt="">';
                        newcode += '</a>';
                        newcode += '</div>';
                        newcode += '<div class="blog-item-text">';
                        newcode += '<h3>';
                        newcode += '<a href="' + el.find("link").text() + '">' + el.find(
                            "title").text() + '</a>';
                        newcode += '</h3>';
                        newcode += '<div class="meta-tags">';
                        newcode += '<span class="date"><i class="lnr lnr-calendar-full"></i>' +
                            d + '</span>';
                        newcode += '</div>';
                        newcode += '<p>';
                        newcode += el.find("description").text();
                        newcode += '</p>';
                        newcode += ' <a href="' + el.find("link").text() +
                            '" class="btn btn-common btn-rm">Baca Lebih Lengkap</a>';
                        newcode += '</div>';
                        newcode += '</div>';
                        newcode += '</div>';

                        console.log("------------------------");
                        console.log("title      : " + el.find("title").text());
                        console.log("link       : " + el.find("link").text());
                        console.log("description: " + el.find("description").text());
                    });
                    newcode += '</div>';
                    newcode +=
                        '</div><center><a href="http://diskominfo.banjarbarukota.go.id/info/" class="btn btn-common btn-lg">Kabar Lainnya</a></center>';

                    blog.html(newcode);

                }
            });







            //feed to parse
            var feed = "https://banjarbarutv.banjarbarukota.go.id/feed/";


            $.ajax(feed, {
                accepts: {
                    xml: "application/rss+xml"
                },
                dataType: "xml",
                success: function(data) {
                    //Credit: http://stackoverflow.com/questions/10943544/how-to-parse-an-rss-feed-using-javascript
                    var blog = $("#bjbtv");
                    var newcode = "";
                    newcode += '<div class="container">';
                    newcode += '<div class="section-header">';
                    newcode +=
                        '<h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Kabar <span>TV</span></h2>';
                    newcode += '<hr class="lines wow zoomIn" data-wow-delay="0.3s">';
                    newcode += '</div>';
                    newcode += '<div class="row">';
                    $(data).find("item").each(function() { // or "item" or whatever suits your feed
                        var el = $(this);
                        //var desc = el.find("description");
                        // var gambar = desc.find("img").src();
                        var d = new Date(el.find("pubDate").text());
                        //d = d.slice(0, 15);

                        newcode +=
                            '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 blog-item">';
                        newcode +=
                            '<div class="blog-item-wrapper wow fadeInUp" data-wow-delay="0.3s">';
                        newcode += '<div class="blog-item-img">';
                        newcode += '<a href="single-post.html">';
                        newcode += '<img src="" alt="">';
                        newcode += '</a>';
                        newcode += '</div>';
                        newcode += '<div class="blog-item-text">';
                        newcode += '<h3>';
                        newcode += '<a href="' + el.find("link").text() + '">' + el.find(
                            "title").text() + '</a>';
                        newcode += '</h3>';
                        newcode += '<div class="meta-tags">';
                        newcode += '<span class="date"><i class="lnr lnr-calendar-full"></i>' +
                            d + '</span>';
                        newcode += '</div>';
                        newcode += '<p>';
                        newcode += el.find("description").text();
                        newcode += '</p>';
                        newcode += ' <a href="' + el.find("link").text() +
                            '" class="btn btn-common btn-rm">Baca Lebih Lengkap</a>';
                        newcode += '</div>';
                        newcode += '</div>';
                        newcode += '</div>';

                        console.log("------------------------");
                        console.log("title      : " + el.find("title").text());
                        console.log("link       : " + el.find("link").text());
                        console.log("description: " + el.find("description").text());
                    });
                    newcode += '</div>';
                    newcode +=
                        '</div><center><a href="https://banjarbarutv.banjarbarukota.go.id/" class="btn btn-common btn-lg">Kabar Lainnya</a></center>';

                    blog.html(newcode);

                }
            });






        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('#agendaModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var bidangId = button.data('bidang');
                var modal = $(this);
                var bidangName;

                switch (bidangId) {
                    case 1:
                        bidangName = 'Sekretariat'
                        break;
                    case 2:
                        bidangName = 'Informatika'
                        break;
                    case 3:
                        bidangName = 'Komunikasi'
                        break;
                    case 4:
                        bidangName = 'Persandian'
                        break;
                    default:
                        bidangName = 'Bidang tidak diketahui'
                        break;
                }
                modal.find('.modal-title').text('Agenda Bidang ' + bidangName);

                $.ajax({
                    url: '/agenda/' + bidangId,
                    method: 'GET',
                    success: function(data) {
                        var tableBody = $('#agendaTable tbody');
                        tableBody.empty();

                        if (data.length === 0) {
                            // Jika tidak ada event
                            var row =
                                '<tr><td colspan="6" class="text-center">Tidak ada jadwal agenda untuk hari ini.</td></tr>';
                            tableBody.append(row);
                        } else {
                            // Jika ada event
                            data.forEach(function(event) {
                                var row = '<tr>' +
                                    '<td>' + event.title + '</td>' +
                                    '<td>' + event.dihadiri + '</td>' +
                                    '<td>' + event.pakaian + '</td>' +
                                    '<td>' + event.keterangan + '</td>' +
                                    '<td>' + event.start_event + '</td>' +
                                    '<td>' + event.end_event + '</td>' +
                                    '</tr>';
                                tableBody.append(row);
                            });
                        }
                    }
                });

            });
        });
    </script> --}}
</body>

</html>
