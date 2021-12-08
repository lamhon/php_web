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
        .container-mock{
            padding: 10px 300px 50px 300px;
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
                <h1 class="h3 mb-2 text-gray-800">Reply message</h1>
                        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
                            For more information about DataTables, please visit the <a target="_blank"
                                href="https://datatables.net">official DataTables documentation</a>.</p>
                <div class="container-mock">
                    <div class="input-group mb-3">
                        <span class="input-group-text">User ID</span>
                        <input
                            type="text" 
                            class="form-control" 
                            value="US001" 
                            aria-label="Username" 
                            aria-describedby="basic-addon1" 
                            disabled="disabled" 
                            id="useridClipboard"
                        >
                        <button 
                            onclick="clipboard('useridClipboard')" 
                            type="button" 
                            class="btn btn-outline-success" 
                            id="basic-addon1">
                            Copy
                        </button>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon2">User name</span>
                        <input 
                            type="text" 
                            class="form-control" 
                            value="Hoàng Tùng Lâm" 
                            aria-label="Recipient's username" 
                            aria-describedby="basic-addon2" 
                            disabled="disabled" 
                            id="nameClipboard">
                        <button 
                            onclick="clipboard('nameClipboard')" 
                            type="button" 
                            class="btn btn-outline-success" 
                            id="basic-addon1">
                            Copy
                        </button>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon2">Email</span>
                        <input 
                            type="text" 
                            class="form-control" 
                            value="tunglam.sor@gmail.com" 
                            aria-label="Recipient's username" 
                            aria-describedby="basic-addon2" 
                            disabled="disabled" 
                            id="emailClipboard">
                        <button 
                            onclick="clipboard('emailClipboard')" 
                            type="button" 
                            class="btn btn-outline-success" 
                            id="basic-addon1">
                            Copy
                        </button>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon2">Message</span>
                        <textarea 
                            class="form-control"  
                            aria-label="With textarea" 
                            aria-describedby="basic-addon2" 
                            id="infoClipboard"
                            disabled="disabled"
                            >Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ullam quasi consequatur voluptatem soluta commodi, libero deserunt accusamus iste veritatis velit maxime eos repudiandae expedita autem veniam voluptatum, praesentium ipsam eum!
                        </textarea>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon2">Reply</span>
                        <textarea 
                            class="form-control"
                            aria-label="With textarea"
                            aria-describedby="basic-addon2"
                            id="basic-addon2"></textarea>
                    </div>

                    <div class="input-group">
                        <button class="btn btn-primary">Save</button>
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