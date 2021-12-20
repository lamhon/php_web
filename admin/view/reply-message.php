<?php
    include '../view/layout/content/header.php';
?>

<?php
    include '../controller/MessageController.php';
?>

<?php
    $messCon = new MessageController();
    $usermail = '';

    // Check id and initialize variable $id
    if(!isset($_GET['messid']) || ($_GET['messid'] == NULL )){
        echo "<script>window.location = 'message.php'</script>";
    }else{
        $id = $_GET['messid'];
    }

    $getMess = $messCon->getMessById($_GET['messid']);

    //Button save
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if($getMess){
            $mess = $getMess->fetch_assoc();

            $emailRep = $mess['email'];
            $subjectRep = $_POST['subject'];
            $messageRep = $_POST['reply'];
            $nameRep = $mess['username'];
            $messid = $id;
            $sendReply = $messCon->sendMessage($messid, $emailRep, $subjectRep, $messageRep, $nameRep);
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
                    $getMess = $messCon->getMessById($_GET['messid']);
                    if($getMess){
                        while($mess = $getMess->fetch_assoc()){

                ?>
                <form method="POST">
                    <div class="container-mock">
                        <?php
                            if(isset($sendReply)){
                                echo $sendReply;
                            }
                        ?>
                        <div class="input-group mb-3">
                            <span class="input-group-text">User ID</span>
                            <input
                                type="text" 
                                class="form-control" 
                                value="<?php echo $mess['userid'] ?>" 
                                aria-label="Username" 
                                aria-describedby="basic-addon1" 
                                disabled="disabled" 
                                id="useridClipboard"
                                name="userId">
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
                                value="<?php echo $mess['username'] ?>" 
                                aria-label="Recipient's username" 
                                aria-describedby="basic-addon2"
                                disabled="disabled" 
                                id="usernameClipboard"
                                name="userName">
                            <button 
                                onclick="clipboard('usernameClipboard')" 
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
                                value="<?php echo $mess['email'] ?>"
                                aria-label="Recipient's username" 
                                aria-describedby="basic-addon2"
                                disabled="disabled" 
                                id="emailClipboard"
                                name="useremail">
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
                            <input 
                                type="text" 
                                class="form-control" 
                                value="<?php echo $mess['mess'] ?>" 
                                aria-label="Recipient's username" 
                                aria-describedby="basic-addon2"
                                disabled="disabled" 
                                id="messageClipboard"
                                name="message">
                            <button 
                                onclick="clipboard('messageClipboard')" 
                                type="button" 
                                class="btn btn-outline-success" 
                                id="basic-addon1">
                                Copy
                            </button>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Subject</span>
                            <input 
                                type="text"
                                required
                                class="form-control" 
                                aria-label="Recipient's username" 
                                aria-describedby="basic-addon2"
                                placeholder="subject..."
                                name="subject">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon2">Reply</span>
                            <textarea 
                                class="form-control" 
                                required
                                aria-label="With textarea" 
                                aria-describedby="basic-addon2"
                                placeholder="Type your message here..."
                                name="reply"></textarea>
                        </div>

                        <div class="input-group">
                            <button type="submit" class="btn btn-primary">Send</button>
                            <a class="btn btn-secondary" href="message.php">Back</a>
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