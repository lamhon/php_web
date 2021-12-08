<?php
    include '../view/layout/content/header.php';
?>

<?php
    include '../controller/CategoryController.php';
?>

<?php
    $cate = new CategoryController();
    // Check id and initialize variable $id
    if(!isset($_GET['cateid']) || ($_GET['cateid'] == NULL )){
        echo "<script>window.location = 'category.php'</script>";
    }else{
        $id = $_GET['cateid'];
    }

    //Button save
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cateName = $_POST['cateName'];
        $cateStt = $_POST['cateStt'];

        $updateCate = $cate->update_category($id, $cateName, $cateStt);
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
                <h1 class="h3 mb-2 text-gray-800">Category Manager</h1>
                        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                            For more information about DataTables, please visit the <a target="_blank"
                                href="https://datatables.net">official DataTables documentation</a>.</p>
                <?php 
                    $getCate = $cate->getCategory($id);
                    if($getCate){
                        while($result = $getCate->fetch_assoc()){
                ?>

                
                
                <form method="POST">
                    <div class="container-mock">
                        <?php
                            if(isset($updateCate)){
                                echo $updateCate;
                            }
                        ?>
                        <div class="input-group mb-3">
                            <span class="input-group-text">ID</span>
                            <input 
                                type="text" 
                                class="form-control" 
                                value= "<?php echo $id ?>"
                                aria-label="Username" 
                                aria-describedby="basic-addon1" 
                                disabled="disabled" 
                                id="idClipboard"
                                name="cateName">
                            <button 
                                onclick="clipboard('idClipboard')" 
                                type="button" 
                                class="btn btn-outline-success" 
                                id="basic-addon1">
                                Copy
                            </button>
                        </div>
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Category name</span>
                            <input 
                                type="text"
                                class="form-control" 
                                value= "<?php echo $result['categoryname'] ?>"
                                aria-label="Recipient's username" 
                                aria-describedby="basic-addon2" 
                                id="nameClipboard"
                                name="cateName"
                                required="required">
                                
                            <button 
                                onclick="clipboard('nameClipboard')" 
                                type="button" 
                                class="btn btn-outline-success" 
                                id="basic-addon1">
                                Copy
                            </button>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" for="inputGroupSelect01">Status</span>
                            <?php 
                                if($result['stt'] == 0){
                            ?>
                            <select class="form-control" id="inputGroupSelect01" name="cateStt">
                                <option value="0">Not working</option>
                                <option value="1">Active</option>
                            </select>
                            <?php
                                }else{
                            ?>
                            <select class="form-control" id="inputGroupSelect01" name="cateStt">
                                <option value="1">Active</option>
                                <option value="0">Not working</option>
                            </select>
                            <?php
                                }
                            ?>
                        </div>

                        <div class="input-group">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="category.php" class="btn btn-secondary">Back</a>
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
    </script>
</body>

</html> 