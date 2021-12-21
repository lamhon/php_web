<?php 
    include '../view/layout/content/header.php'; 
?>

<?php
    include '../controller/OrderController.php';
?>

<?php
    $orderCon = new OrderController();

    if(isset($_GET['delivered'])){
        $checkid = $orderCon->checkOrderid($_GET['delivered']);
        if($checkid){
            $successOrder = $orderCon->updateDeliveryDate($_GET['delivered']);
            if($successOrder){
                header('Location:confirm-order.php');
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sor Admin - Confirm Orders</title>

    <?php 
        include './layout/cssfile.php';
    ?>
    <!-- Custom styles for this page -->
    <link href="./assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <style>
        td a{
            /* text-decoration: none; */
            font-weight: bold;
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
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Confirm Orders</h1>
                    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                        For more information about DataTables, please visit the <a target="_blank"
                            href="https://datatables.net">official DataTables documentation</a>.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Confirm Orders</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
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
                                            <th>No</th>
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
                                        <?php
                                            $lstOrder = $orderCon->getlstOrder(1);
                                            $i = 0;
                                            if($lstOrder){
                                                while($order = $lstOrder->fetch_assoc()){
                                                    if(!isset($order['deliverydate'])){
                                                        $i++;
                                        ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><a href="../../user/view/order-info.php?id=<?php echo $order['id'] ?>"><?php echo $order['id'] ?></a></td>
                                                <td><?php echo $order['userid'] ?></td>
                                                <td><?php echo $order['username'] ?></td>
                                                <td><?php echo $order['useraddress'] ?></td>
                                                <td><?php echo $order['phone'] ?></td>
                                                <td><?php echo $order['note'] ?></td>
                                                <td>
                                                    <?php
                                                        if($order['paid'] == 0){
                                                            echo '<p style="color: red;">unpaid</p>';
                                                        }else{
                                                            echo '<p style="color: green;">paid</p>';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $order['dateorder'] ?></td>
                                                <td><a href="?delivered=<?php echo $order['id'] ?>" class="btn btn-success">Complete <i class="fas fa-check"></i></a></td>
                                            </tr>
                                        <?php
                                                    }
                                                }
                                            }
                                        ?>
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

</body>

</html>