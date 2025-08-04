<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Dashboard')</title>
    
    <!-- Font Awesome -->
    <link href="{{ asset('sb-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- SB Admin CSS -->
    <link href="{{ asset('sb-admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}?v={{ time() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    @stack('styles')
</head>
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('partials.sidebar')
        <!-- End Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <!-- Topbar -->
                @include('partials.topbar')
                <!-- End Topbar -->

                <!-- Main Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            <!-- Footer -->
            @include('partials.footer')
        </div>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Core JS -->
    <script src="{{ asset('sb-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('sb-admin/js/sb-admin-2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


    {{-- <script src="{{ asset('sb-admin/vendor/jquery/jquery.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


 <script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggleBtn = document.getElementById('sidebarToggleTop');

        // Tutup sidebar hanya di mobile saat load
        if (window.innerWidth <= 768) {
            sidebar.classList.add('toggled');
        } else {
            sidebar.classList.remove('toggled'); // pastikan terbuka di desktop
        }

        // Klik hamburger
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('toggled');
            overlay.classList.toggle('active');
        });

        // Klik overlay untuk menutup (hanya di mobile)
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('toggled');
            overlay.classList.remove('active');
        });

        // Auto-resize (mobile ↔ desktop)
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('toggled');
                overlay.classList.remove('active');
            }
        });
    });

        $(document).ready(function() {
        $('#assignTable').DataTable({
            responsive: true,
            autoWidth: false
        });

        $('#employeeTable').DataTable({
            responsive: true,
            autoWidth: false
        });
    });
</script>




    @stack('scripts')
</body>
</html>
