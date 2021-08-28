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
                            <h1 class="m-0"> Program <small>NRB Finder</small></h1>
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
                            <img src="{{ asset('/images/enseval-logo.png') }}" alt="Enseval"
                                style="width:100px; padding:10px;">
                            <img src="{{ asset('/images/alfamart-logo.png') }}" alt="Enseval"
                                style="width:100px; padding:10px;">
                            <img src="{{ asset('/images/alfamidi-logo.png') }}" alt="Enseval"
                                style="width:100px; padding:10px;">
                            <img src="{{ asset('/images/dan-dan-logo.png') }}" alt="Enseval"
                                style="width:100px; padding:10px;">
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row pt-3">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group p-0 m-0"><select class="form-control selectarea">
                                                            <option value="">Select Area</option>
                                                            <option value="Bekasi">
                                                                Bekasi
                                                            </option>
                                                            <option value="Balaraja">
                                                                Balaraja
                                                            </option>
                                                            <option value="Bogor">
                                                                Bogor
                                                            </option>
                                                            <option value="Cikokol">
                                                                Cikokol
                                                            </option>
                                                            <option value="Cileungsi_2">
                                                                Cileungsi_2
                                                            </option>
                                                            <option value="Karawang">
                                                                Karawang
                                                            </option>
                                                        </select></div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group p-0 m-0">
                                                        <div class="input-group"><input type="text"
                                                                placeholder="yyyy-mm-dd" class="form-control datefrom" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                                            <div class="input-group-prepend"><span
                                                                    class="input-group-text"><i
                                                                        class="far fa-calendar-alt"></i></span></div>
                                                            <input type="text" placeholder="yyyy-mm-dd"
                                                                class="form-control dateto" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4"><button type="button" class="btn btn-info btn-submit" data-filter="false" onclick="searchFilters()">
                                                        Submit
                                                    </button></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-sm"><input type="text"
                                                    name="table_search" placeholder="Search"
                                                    class="form-control float-right input-search">
                                                <div class="input-group-append"><button type="button"
                                                        onclick="searchHome()" class="btn btn-default"><i
                                                            class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-3">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-check"><input type="checkbox" true-value="true"
                                                            false-value="false" id="exampleCheck1"
                                                            class="form-check-input checksudah"> <label for="exampleCheck1"
                                                            class="form-check-label">Sudah
                                                            Ditarik</label></div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-check"><input type="checkbox" true-value="true"
                                                            false-value="false" id="exampleCheck1"
                                                            class="form-check-input checkbelum"> <label for="exampleCheck1"
                                                            class="form-check-label">Belum
                                                            Ditarik</label></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="table-home card-body table-responsive p-0 d-none " style="height: 400px;">
                                    <table id="tabel_cari" class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Tgl Retur</th>
                                                <th>No. RTV</th>
                                                <th>No. Draft</th>
                                                <th>Amount (Rp.)</th>
                                                <th>Branch</th>
                                                <th>Dir</th>
                                                <th>Tanggal Tarik</th>
                                                <th>Ekspedisi</th>
                                                <th>No. TTRS</th>
                                                <th>Tanggal TTRS</th>
                                                <th>No. RMA</th>
                                                <th>Tanggal RMA</th>
                                                <th>No. CN</th>
                                                <th>Tanggal CN </th>
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
    <script src="{{ asset('/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        var filters = "";
        var selectarea = "";
        var datefrom = "";
        var dateto = "";
        var checksudah = false;
        var checkbelum = false;
        var more = true;
        var skip = 0;
        var take = 1000;
        var search = 1;

        $('.datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' });
        $('[data-mask]').inputmask();
       
        function searchFilters(){
            $(".btn-submit").attr("data-filter","true");
            searchHome();
        }

        function tabelCari(){
            $('#tabel_cari').on('scroll', function() {
            console.log("asdasd");
        });
        }

        function searchHome() {
            selectarea = $('.selectarea').val();
            datefrom = $('.datefrom').val();
            dateto = $('.dateto').val();
            checksudah = $('.checksudah').is(':checked');
            checkbelum = $('.checkbelum').is(':checked');
            search = $('.input-search').val();
            filters = $(".btn-submit").attr("data-filter");

            var url = "filters=" + filters + "&selectarea=" + selectarea + "&datefrom=" + datefrom + "&dateto=" +
                dateto + "&checksudah=" + checksudah + "&checkbelum=" + checkbelum + "&more="+more+"&skip="+skip+"&take="+take+"&search="+search+"";

            $('.nrb-list').html('');
            $('.table-home').removeClass('d-none');
            $.get("api/fin?" + url, function (data, status) {
                $.each(data.data, function (i, value) {
                    $(".nrb-list").append("<tr><th>" + value.tgl_retur + "</th><th>" + value.no_nrb +
                        "</th><th>" + value.no_draft + "</th><th>" + numberFormat(value.amount) +
                        "</th><th>" + (value.branch) + "</th><th>" + (value.dir) + "</th><th>" + (
                            value.tgl_tarik) + "</th><th>" +
                        (value.driver) + "</th><th>" + (value.no_ttrs) + "</th><th>" + (value
                            .tgl_ttrs) + "</th><th>" + (value.no_rma) + "</th><th>" + (value
                            .tgl_rma) + "</th><th>" + (value.no_cn) + "</th><th>" + (value.tgl_cn) +
                        "</th></tr>"
                    );
                    tabelCari();
                });
            });
        }

        function numberFormat(value) {
            if (parseInt(value)) {
                value = parseInt(value);
                return value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
            } else {
                return '0';
            }
        }

    </script>
</body>

</html>
