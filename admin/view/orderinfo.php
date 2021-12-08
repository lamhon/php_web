<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sor Admin - Setting</title>

    <?php 
        include './layout/cssfile.php';
    ?>

    <!-- Custom styles for this page -->
    <link href="./assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        .container-mock{
            padding: 10px 50px 50px 50px;
        }

        .input-group button{
            margin-left: 5px;
        }

        .input-group span{
            margin-right: 5px;
        }

        .input-group-mock{
            margin: 0 auto 0 auto;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            include './layout/content/sidebar.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <?php 
                        include './layout/content/topbar.php';
                    ?>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <h1 class="h3 mb-2 text-gray-800">Order Information</h1>
                        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                            For more information about DataTables, please visit the <a target="_blank"
                                href="https://datatables.net">official DataTables documentation</a>.</p>
                <div class="container-mock">
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Orders Information</h6>
                            <div class="header-container-mock">
                                <p>Order ID: <span>HD001</span></p>
                                <p>Receiver: <span>Hoàng Tùng Lâm</span></p>
                                <p>Address: <span>79 Buôn Ju, TP BMT</span></p>
                                <p>Phone: <span>0345071246</span></p>
                                <p>Note: <span>Không có note nè</span></p>
                                <p>Date order: <span>25/7/2021</span></p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>User ID</th>
                                            <th>User name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Note</th>
                                            <th>Paid</th>
                                            <th>Order date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>User ID</th>
                                            <th>User name</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Note</th>
                                            <th>Paid</th>
                                            <th>Order date</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td><a href="#">HD001</a></td>
                                            <td>US001</td>
                                            <td>Hoàng Tùng Lâm</td>
                                            <td>79 Buôn Ju, TP BMT</td>
                                            <td>0345071246</td>
                                            <td>Không có</td>
                                            <td>Đã thanh toán</td>
                                            <td>2/5/2018</td>
                                            <td><button class="btn btn-success">Confirm <i class="fas fa-check"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    
                </div>
                
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php
                include './layout/content/footer.php';
            ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php
        include './layout/content/logout.php';
    ?>

    <!-- Bootstrap core JavaScript-->
    <?php
        include './layout/jsfile.php';
    ?>
    <!-- Page level plugins -->
    <script src="./assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="./assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="./assets/js/demo/datatables-demo.js"></script>

    <script>
        function clipboard(value){
            /* Get the text field */
            var copyText = document.getElementById(value);

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);
        }
    </script>
</body>

</html>