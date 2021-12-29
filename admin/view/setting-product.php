<?php
    include '../view/layout/content/header.php';
?>

<?php
    include '../controller/CategoryController.php';
    include '../controller/ProductController.php';
    include '../model/product.php';
?>

<?php
    $product = new ProductController();

    // Check id and initialize variable $id
    if(!isset($_GET['productid']) || ($_GET['productid'] == NULL )){
        echo "<script>window.location = 'product.php'</script>";
    }else{
        $id = $_GET['productid'];
    }

    //Button save
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $setproduct = new Product(
                                    $_POST['productName'],
                                    $_POST['productPrice'],
                                    $_POST['productSale'],
                                    $_POST['productCategory'],
                                    $_POST['productInfo'],
                                    $_POST['productDescript'],
                                    $_POST['productQuantity'],
                                    $_POST['productStt']);
        $setproduct->setproductId($id);

        $updateProduct = $product->update_product($setproduct, $_FILES);
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

    <title>Sor Admin - Setting</title>

    <?php 
        include './layout/cssfile.php';
    ?>

    <style>
        .input-group img{
            width: 120px;
            height: 130px;
        }

        #upload-photo{
            opacity: 0;
            position: absolute;
            z-index: -1;
        }

        .input-group .img{
            margin-right: 5px;
            margin-left: 5px;
        }

        .container-upload{
            position: relative;
            width: 120px;
        }

        .img{
            opacity: 1;
            display: block;
            width: 120px;
            height: 130px;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle-upload{
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .container-upload:hover .img{
            opacity: 0.5;
        }

        .container-upload:hover .middle-upload{
            opacity: 1;
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
                <h1 class="h3 mb-2 text-gray-800">Product Manager</h1>
                        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                            For more information about DataTables, please visit the <a target="_blank"
                                href="https://datatables.net">official DataTables documentation</a>.</p>
                
                <?php
                    $getProduct = $product->getProduct($id);
                    if($getProduct){
                        while($result = $getProduct->fetch_assoc()){

                ?>
                <form method="POST" enctype="multipart/form-data">
                    <div class="container-mock">
                        <?php
                            if(isset($updateProduct)){
                                echo $updateProduct;
                            }
                        ?>
                        <div class="input-group mb-3">
                            <span class="input-group-text">ID</span>
                            <input 
                                type="text" 
                                class="form-control" 
                                value="<?php echo $result['id'] ?>" 
                                aria-label="Username" 
                                aria-describedby="basic-addon1" 
                                disabled="disabled" 
                                id="idClipboard"
                                name="productId">
                            <button 
                                onclick="clipboard('idClipboard')" 
                                type="button" 
                                class="btn btn-outline-success" 
                                id="basic-addon1">
                                Copy
                            </button>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Product name</span>
                            <input 
                                type="text" 
                                class="form-control" 
                                value="<?php echo $result['productname'] ?>" 
                                aria-label="Recipient's username" 
                                aria-describedby="basic-addon2" 
                                id="nameClipboard"
                                name="productName">
                            <button 
                                onclick="clipboard('nameClipboard')" 
                                type="button" 
                                class="btn btn-outline-success" 
                                id="basic-addon1">
                                Copy
                            </button>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Price</span>
                            <input 
                                type="text" 
                                class="form-control" 
                                value="<?php echo number_format($result['price'], 0, '', ',')  ?>" 
                                aria-label="Recipient's username" 
                                aria-describedby="basic-addon2" 
                                id="currency-field"
                                data-type="currency"
                                required="required"
                                name="productPrice">
                            <span class="input-group-text">VNĐ</span>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Sale</span>
                            <input 
                                style="margin-right:5px" 
                                type="text"
                                value="<?php echo $result['sale'] ?>"
                                aria-label="50%" 
                                class="form-control"
                                name="productSale"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                            <span class="input-group-text">%</span>
                        </div>
                        <?php 
                            $cate = new CategoryController();
                        ?>

                        <div class="input-group mb-3">
                            <span class="input-group-text" for="inputGroupSelect01">Category</span>
                            <select class="form-control" id="inputGroupSelect01" name="productCategory">
                                <?php
                                    $cateName = $cate->getCategory($result['categoryid']);
                                    if($cateName){
                                        while($categoryname = $cateName->fetch_assoc()){
                                ?>
                                <option value="<?php echo $categoryname['id'] ?>">
                                    <?php
                                        $defaultCate = $categoryname['categoryname'];
                                        echo $defaultCate;
                                    ?>
                                </option>
                                <?php
                                        }
                                    }
                                ?>
                                <?php
                                    $show = $cate->getAll_categoryByStt(1);
                                    if($show){
                                        while($cateOp = $show->fetch_assoc()){
                                            if(strcmp($cateOp['categoryname'], $defaultCate) != 0){
                                ?>
                                <option value="<?php echo $cateOp['id'] ?>"><?php echo $cateOp['categoryname'] ?></option>
                                <?php
                                            }
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
                                name="productInfo"
                                id="infoClipboard"><?php echo $result['info'] ?></textarea>
                            <button 
                                onclick="clipboard('infoClipboard')" 
                                type="button" 
                                class="btn btn-outline-success" 
                                id="basic-addon1">
                                Copy
                            </button>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Description</span>
                            <textarea 
                                class="form-control" 
                                aria-label="With textarea" 
                                aria-describedby="basic-addon2"
                                name="productDescript"
                                id="descriptClipboard"><?php echo $result['descript'] ?></textarea>
                            <button 
                                onclick="clipboard('descriptClipboard')" 
                                type="button" 
                                class="btn btn-outline-success" 
                                id="basic-addon1">
                                Copy
                            </button>
                        </div>
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Quantity</span>
                            <input 
                                type="text" 
                                class="form-control" 
                                value="<?php echo $result['quantity'] ?>"
                                aria-label="Recipient's username" 
                                aria-describedby="basic-addon2"
                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                name="productQuantity">
                        </div>

                        <div class="container-upload input-group mb-3">
                            <!-- <label class="input-group-text" for="inputGroupFile01">Image</label> -->
                            <label class="img" for="upload-photo"><img id="productImg" src="../../public/<?php echo $result['img']?>" alt="Photo"></label>
                            <input type="file" class="form-control" name="image" id="upload-photo" onchange="readURL(this);">
                            <div class="middle-upload">
                                <div class="text-upload"><i class="fas fa-arrow-circle-up text-black-300"></i></div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" for="inputGroupSelect01">Status</span>
                            <select class="form-control" id="inputGroupSelect01" name="productStt">
                                <?php
                                    if($result['stt'] == 1){

                                ?>
                                <option value="1">Active</option>
                                <option value="0">Locked</option>
                                <?php
                                    }else{
                                ?>
                                <option value="0">Locked</option>
                                <option value="1">Active</option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="input-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a class="btn btn-secondary" href="product.php">Back</a>
                        </div>

                        
                    </div>
                </form>
                <?php
                        }
                    }
                ?>
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

        function readURL(input){
            if(input.files && input.files[0]){
                let reader = new FileReader();

                reader.onload = function(e){
                    $('#productImg')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>