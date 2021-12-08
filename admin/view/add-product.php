<?php
    include '../view/layout/content/header.php';
?>
<?php
    include '../controller/CategoryController.php';
    include '../controller/ProductController.php';
?>
<?php
    $product = new ProductController();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insert_product = $product->insert_product($_POST, $_FILES);
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

    <title>Sor Admin - Add Product</title>

    <?php 
        include '../view/layout/cssfile.php';
    ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            include '../view/layout/content/sidebar.php';
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
                <h1 class="h3 mb-2 text-gray-800">Add Product</h1>
                        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                            For more information about DataTables, please visit the <a target="_blank"
                                href="https://datatables.net">official DataTables documentation</a>.</p>
                <form action="add-product.php" method="POST" enctype="multipart/form-data">
                    <div class="container-mock">
                        <?php
                            if(isset($insert_product)){
                                echo $insert_product;
                            }
                        ?>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Product name</span>
                            <input 
                                type="text" 
                                class="form-control"
                                aria-label="Recipient's username" 
                                aria-describedby="basic-addon2" 
                                id="nameClipboard"
                                name="productName"
                                required="required">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Price</span>
                            <input 
                                type="text" 
                                class="form-control"
                                value="0"
                                aria-label="Recipient's username" 
                                aria-describedby="basic-addon2" 
                                id="currency-field"
                                data-type="currency"
                                required="required"
                                name="productPrice">
                            <span class="input-group-text" id="basic-addon2">VNĐ</span>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Sale</span>
                            <input 
                                style="margin-right:5px" 
                                type="text" 
                                aria-label="50%" 
                                class="form-control"
                                value="0"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                name="productSale">
                            <span class="input-group-text">%</span>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" for="inputGroupSelect01">Category</span>
                            <select class="form-control" id="inputGroupSelect01" name="productCategory">
                                <option>--Select category--</option>
                                <?php
                                    $cate = new CategoryController();
                                    $cateList = $cate->getAll_category();
                                    if($cateList){
                                        while($result = $cateList->fetch_assoc()){
                                ?>
                                <option value="<?php echo $result['id']?>"><?php echo $result['categoryname']?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Information</span>
                            <textarea 
                                class="form-control"  
                                aria-label="With textarea" 
                                aria-describedby="basic-addon2" 
                                id="infoClipboard"
                                name="productInformation"></textarea>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Description</span>
                            <textarea 
                                class="form-control" 
                                aria-label="With textarea" 
                                aria-describedby="basic-addon2" 
                                id="descriptClipboard"
                                name="productDescription"></textarea>
                        </div>
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Quantity</span>
                            <input 
                                type="text" 
                                class="form-control"
                                aria-label="Recipient's username" 
                                aria-describedby="basic-addon2"
                                name="productQuantity"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                        </div>

                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupFile01">Image</label>
                            <input type="file" class="form-control" name="image" id="inputGroupFile01" required="required">
                        </div>

                        <div class="input-group">
                            <button type="submit" name="submit" class="btn btn-primary">Add</button>
                            <a href="product.php" class="btn btn-secondary">Back</a>
                        </div>
                    </div>
                </form>
                
                
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
</body>

</html>