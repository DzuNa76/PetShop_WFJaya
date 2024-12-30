<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'WF Jaya')</title>

    <!-- Custom fonts for this template -->
    <link href="{{ asset('/admin-source/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('/admin-source/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/admin-source/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>

<body id="page-top">

    <div id="wrapper">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        <!-- End of Sidebar -->

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- Topbar -->
                @include('admin.layouts.topbar')
                <!-- End of Topbar -->

                <!-- Main Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- End of Main Content -->
            </div>

            <!-- Footer -->
            @include('admin.layouts.footer')
            <!-- End of Footer -->
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    @include('admin.layouts.logout-modal')

    <!-- JavaScript files -->
    <script src="{{ asset('/admin-source/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admin-source/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/admin-source/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('/admin-source/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('/admin-source/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/admin-source/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/admin-source/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('/admin-source/vendor/chart.js/Chart.min.js') }}"></script>
    
</body>

</html>
