<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | View Products</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
                width="60">
        </div>

        @include('admin.nav')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">View Products</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                <li class="breadcrumb-item active">View Products</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @if (session('deletemsg'))
                        <div class="alert alert-success" role="alert">
                            {{ session('deletemsg') }}
                        </div>
                    @elseif (session('errordelmsg'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('errordelmsg') }}
                        </div>
                    @endif
                    <table class="table table-bordered mt-3">
                        <thead align="center">
                            <tr>
                                <th scope="col">Sr No.</th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            @php
                                $count = 0;
                            @endphp
                            @if ($number_of_rows != 0)
                                @foreach ($productdetails as $productdetail)
                                    <tr>
                                        <th scope="row">{{ $count = $count + 1 }}</th>
                                        <td>
                                            @if ($productdetail->image != '')
                                                <a href="javascript:void(0)">
                                                    <img src="{{ url('/') }}/productimage/{{ $productdetail->image }}"
                                                        class="" alt="Avatar" width=80px height="80px"></a>
                                            @else
                                                <a href="javascript:void(0)">
                                                    <img src="{{ url('/') }}/productimage/noimage.jpg"
                                                        class="" alt="Avatar" width=80px height="80px"></a>
                                            @endif
                                        </td>
                                        <td>{{ $productdetail['name'] }}</td>
                                        <td>{{ $productdetail['price'] }}</td>
                                        <td>
                                            <a href="edit_products/{{ $productdetail['id'] }}" type="button"
                                                class="btn"><i class="fas fa-edit" style="color: white;"></i></a>
                                            <a href="delete_products/{{ $productdetail['id'] }}" type="button"
                                                class="btn"><i class="far fa-trash-alt" style="color: white;"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">No Records Available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="text-center">
                    <div>
                        {{ $productdetails->links() }}
                    </div>
                </div>
                </div>
                <!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <!-- <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer> -->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="../plugins/raphael/raphael.min.js"></script>
    <script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <script>
        $(document).ready(function() {
            window.setTimeout(function() {
                $(".alert").fadeTo(700, 0).slideUp(700, function() {
                    $(this).remove();
                });
            }, 700);
        });
    </script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="dist/js/demo.js"></script> -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="dist/js/pages/dashboard2.js"></script> --}}
</body>

</html>