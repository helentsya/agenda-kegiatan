<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjadwalan Agenda</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    @include('components.navbar')
    @include('components.sidebar')
    @yield('content')
</body>
<script>
    $(document).ready(function() {
        // Toggle sidebar on button click
        $('#sidebarToggle').click(function() {
            $('#sidebar').toggleClass('-translate-x-56');
        });

        // Hide sidebar on tablet and smaller screens
        $(window).resize(function() {
            if ($(window).width() <= 768) {
                $('#main-content').removeClass('ml-56')
                $('#sidebar').addClass('-translate-x-56');
                $('#sidebarToggle').removeClass('hidden');
            } else {
                $('#main-content').addClass('ml-56')
                $('#sidebar').removeClass('-translate-x-56');
                $('#sidebarToggle').addClass('hidden');
            }
        });


        $(document).on('click', function(event) {
            // Cek apakah elemen yang diklik bukan bagian dari sidebar atau toggleButton
            if (!$(event.target).closest('#sidebar, #sidebarToggle').length) {
                // Tutup sidebar jika diklik di luar

                if ($(window).width() <= 768) {
                    $('#sidebar').addClass('-translate-x-56');
                }
            }
        });
        // Trigger resize event on page load
        $(window).resize();
    });
</script>

</html>
