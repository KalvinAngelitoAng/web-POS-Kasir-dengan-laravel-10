<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $title }}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon.png">
    <!-- Custom Stylesheet -->
    <link href="/assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="#">
                    <b class="logo-abbr"><img src="/assets/images/logo.png" alt=""> </b>
                    <span class="logo-compact"><img src="/assets/images/logo-compact.png" alt=""></span>
                    <span class="brand-title">
                        <h3 style="color: white;">Sistem Kasir</h3>
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">

                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>{{ Auth::user()->name }}
                                <img src="/assets/images/user/form-user.png" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="/profile"><i class="icon-user"></i> <span>Profile</span></a>
                                        </li>
                                        <hr class="my-2">
                                        <li><a href="/logout"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label">Dashboard</li>
                    <li>
                        <a href="/home" aria-expanded="false">
                            <i class="fa fa-dashboard menu-icon"></i><span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-label">UI Components</li>

                    @if (Auth::user()->role == 'admin')

                    <li>
                        <a href="/setdiskon" aria-expanded="false">
                            <i class="fa fa-tags menu-icon"></i><span class="nav-text">Setting Diskon</span>
                        </a>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-briefcase menu-icon"></i><span class="nav-text">Data Master</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="/user">Data User</a></li>
                            <li><a href="/jenisbarang">Data Jenis Barang</a></li>
                            <li><a href="/barang">Data Barang</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/laporan" aria-expanded="false">
                            <i class="fa fa-file menu-icon"></i><span class="nav-text">Data Laporan</span>
                        </a>
                    </li>

                    @endif

                    @if (Auth::user()->role == 'kasir')

                    <li>
                        <a href="/transaksi" aria-expanded="false">
                            <i class="fa fa-desktop menu-icon"></i><span class="nav-text">Data Transaksi</span>
                        </a>
                    </li>

                    @endif
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        @yield('content')


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="#">Quixlab</a> 2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="/assets/plugins/common/common.min.js"></script>
    <script src="/assets/js/custom.min.js"></script>
    <script src="/assets/js/settings.js"></script>
    <script src="/assets/js/gleek.js"></script>
    <script src="/assets/js/styleSwitcher.js"></script>

    <script src="/assets/plugins/tables/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/tables/js/datatable-init/datatable-basic.min.js"></script>

    <script src="/assets/js/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="/assets/js/sweetalert/sweetalert.min.js"></script>

    <script type="text/javascript">
        $("#id_barang").change(function(){
        var id_barang = $("#id_barang").val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            url : "/transaksi/get_detail_barang",
            data: "id_barang="+id_barang,
            cache:false,
            success: function(data){
                $('#tampil_barang').html(data);
            }
        });
    });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#total_bayar, #uang_pembeli, #kembalian").keyup(function() {
                var total_bayar  = $("#total_bayar").val();
                var uang_pembeli = $("#uang_pembeli").val();

                var kembalian = parseInt(uang_pembeli) - parseInt(total_bayar);
                $("#kembalian").val(kembalian);
            });
        });
    </script>

    @if (session('success'))
    <script>
        var SweetAlert2Demo = function() {
            var initDemos = function() {

                swal({
                    title: "{{ session('success') }}",
                    text: "{{ session('success') }}",
                    icon: "success",
                    buttons: {
                        confirm: {
                            text: "Confirm Me",
                            value: true,
                            visible: true,
                            className: "btn btn-success",
                            closeModal: true
                        }
                    }
                });
        };

        return {
            init: function() {
                initDemos();
            },
        };
    }();

    jQuery(document).ready(function() {
        SweetAlert2Demo.init();
    });
    </script>
    @endif

    @if (session('error'))
    <script>
        var SweetAlert2Demo = function() {
            var initDemos = function() {

                swal({
                    title: "{{ session('error') }}",
                    text: "{{ session('error') }}",
                    icon: "error",
                    buttons: {
                        confirm: {
                            text: "Confirm Me",
                            value: true,
                            visible: true,
                            className: "btn btn-success",
                            closeModal: true
                        }
                    }
                });
        };

        return {
            init: function() {
                initDemos();
            },
        };
    }();

    jQuery(document).ready(function() {
        SweetAlert2Demo.init();
    });
    </script>
    @endif

</body>

</html>
