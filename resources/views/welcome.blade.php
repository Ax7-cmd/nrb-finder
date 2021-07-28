<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <img src="{{ asset('/images/logo.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
                </a>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Messages Dropdown Menu -->
                    @if (Route::has('login'))
                        @auth
                        <li class="nav-item">
                            <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </li>
                        @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"> Prototipe Program <small>NRB Finder</small></h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <img src="{{ asset('/images/enseval-logo.png') }}" alt="Enseval" style="width:100px; padding:10px;">
                            <img src="{{ asset('/images/alfamart-logo.png') }}" alt="Enseval" style="width:100px; padding:10px;">
                            <img src="{{ asset('/images/alfamidi-logo.png') }}" alt="Enseval" style="width:100px; padding:10px;">
                            <img src="{{ asset('/images/dan-dan-logo.png') }}" alt="Enseval" style="width:100px; padding:10px;">
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-10">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 400px;">
                                            <input type="text" name="table_search"
                                                class="form-control float-right input-search" placeholder="Masukkan No. Nrb / No. Draf">

                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-default" onclick="searchHome()">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="table-home card-body table-responsive p-0 d-none " style="height: 400px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Tgl Retur</th>
                                                <th>No. Faktur</th>
                                                <th>Amount (Rp.)</th>
                                                <th>No. Draf Retur</th>
                                            </tr>
                                        </thead>
                                        <tbody class="nrb-list">
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ mix('/js/app.js') }}"></script>
    <script>
        function searchHome(){
            $('.nrb-list').html('');
            $('.table-home').removeClass('d-none');
            $.get("api/nrb?search="+$('.input-search').val(), function(data, status){
                $.each(data.data, function(i, value) {
                    console.log(value);
                    $(".nrb-list").append("<tr><th>"+value.tgl_retur+"</th><th>"+value.no_faktur+"</th><th>"+value.amount+"</th><th>"+value.no_draf_retur+"</th></tr>");
                });
            });
        }
    </script>
</body>

</html>
