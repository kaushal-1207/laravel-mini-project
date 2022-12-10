<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Edit Customer</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <style>
        .alert {
            width: 70%;
        }
    </style>
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60"
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
                            <h1 class="m-0">Edit Customers</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                                <li class="breadcrumb-item active">Edit Customers</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @if (session('reqmsg'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('reqmsg') }}
                        </div>
                    @elseif (session('existsmsg'))
                        <div class="alert alert-warning" role="alert">
                            {{ session('existsmsg') }}
                        </div>
                    @elseif (session('successmsg'))
                        <div class="alert alert-success" role="alert">
                            {{ session('successmsg') }}
                        </div>
                    @elseif (session('failedmsg'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('failedmsg') }}
                        </div>
                    @endif
                    <form action="/admin/edit_customers/editcustomerform" method="POST">
                        @csrf
                        <input type="hidden" name="update_id" value="{{ $editcustomerdetails['id'] }}">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Customer Name <sup style="color: red;">*</sup></label>
                                <input type="text" class="form-control" name="c_name" id="c_name"
                                    placeholder="Customer Name" value="{{ $editcustomerdetails['c_name'] }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="exampleInputFile">Customer Contact</label><br>
                                <input type="number" class="form-control" name="c_contact" id="c_contact"
                                    placeholder="Customer Contact" value="{{ $editcustomerdetails['contact'] }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="">Customer Email <sup style="color: red;">*</sup></label>
                                <input type="text" class="form-control" name="c_email" id="c_email"
                                    placeholder="Customer Email" value="{{ $editcustomerdetails['email'] }}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="exampleInputFile">Select Product</label><br>
                                <select class="form-control" name="p_id" id="p_id" required>
                                    <option value="">-- Select One --</option>
                                    @foreach ($productdetails as $productdetail)
                                        @if ($editcustomerdetails['product_id'] == $productdetail['id'])
                                            @php
                                                $selected = 'selected';
                                            @endphp
                                        @else
                                            @php
                                                $selected = '';
                                            @endphp
                                        @endif
                                        <option value="{{ $productdetail['id'] }}" {{ $selected }}>
                                            {{ $productdetail['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <center>
                            <button type="submit" class="btn btn-success">Submit</button>&nbsp;
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </center>
                    </form>
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
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="../../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="../../plugins/raphael/raphael.min.js"></script>
    <script src="../../plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="../../plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="../../plugins/chart.js/Chart.min.js"></script>
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
