<?php
    include '../view/layouts/content/session.php';
?>

<?php
    include '../controller/UserController.php';
    include '../controller/CartController.php';
?>

<?php
    $userCon = new UserController();
    $cartCon = new CartController();
    $user = $userCon->getUser(Session::get('userId'));

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $updateInfo = $userCon->Switch($_POST['update_profile']);
        // var_dump($_POST['update_profile']);
    }
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sor Decor - Profile</title>

    <?php
        include './layouts/cssfile.php';
    ?>
    <style>
        .container-mock{
            padding: 10px 650px 50px 650px;
        }

        .input-group span{
            margin-left: 5px;
            margin-right: 5px;
        }

        .input-group button{
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <ul class="offcanvas__widget">
            <li><span class="icon_search search-switch"></span></li>
            <li>
                <a href="?action=logout">
                    <span class="icon_heart_alt"></span>
                    <div class="tip">2</div>
                </a>
            </li>
            <li>
                <a href="#">
                    <span class="icon_bag_alt"></span>
                    <div class="tip">2</div>
                </a>
            </li>
        </ul>
        <div class="offcanvas__logo">
            <a href="./index.html"><img src="./assets/img/logo.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth">
            <a href="#">Login</a>
            <a href="#">Register</a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <?php 
        include './layouts/content/header.php';
    ?>
    

    <div class="container-mock">
        <div class="filter">
            <ul class="filter__controls">
                <li class="active" data-filter=".profile"><a href="profile.php">Profile</a></li>
                <li data-filter=".order"><a href="order.php">Your order</a></li>
                <li data-filter=".pending"><a href="pending.php">Pending order</a></li>
                <li data-filter=".delivered"><a href="delivered.php">Delivered order</a></li>
            </ul>
        </div>
        <div class="mix profile">
            <h5>My profile</h5>
        </div>
        
        <p>Manage your information and security</p>
        <hr>
        <?php
            if(isset($updateInfo)){ 
                //parse_str($urBirth, $res);
                echo $updateInfo;
                $user = $userCon->getUser(Session::get('userId'));
            }
        ?>
        <form method="POST" action="profile.php">
            <?php
                if($user){
                    while($result = $user->fetch_assoc()){
            ?>
            <!-- Input ID -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">ID</span>
                <input 
                    readonly 
                    type="text"
                    class="form-control"
                    value="<?php echo $result['id'] ?>"
                    aria-label="Username" 
                    aria-describedby="basic-addon1"
                    id="idClipboard"
                    name="userId">
                    <button 
                        onclick="clipboard('idClipboard')" 
                        type="button" 
                        class="btn btn-outline-success" 
                        id="basic-addon1">
                        Copy
                    </button>
            </div>
            <!-- Input Username -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Username</span>
                <input 
                    readonly 
                    type="text" 
                    class="form-control"
                    value="<?php echo $result['username'] ?>"
                    aria-label="Username" 
                    aria-describedby="basic-addon1"
                    id="usernameClipboard"
                    name="userUsername">
                    <button 
                        onclick="clipboard('usernameClipboard')" 
                        type="button" 
                        class="btn btn-outline-success" 
                        id="basic-addon1">
                        Copy
                    </button>
            </div>
            <!-- Input First and lastname -->
            <div class="input-group mb-3">
                <span class="input-group-text">First name</span>
                <input required type="text" class="form-control" aria-label="Username" value="<?php echo $result['firstname'] ?>" name="userFirstname">
                <span class="input-group-text">Last name</span>
                <input required type="text" class="form-control" aria-label="Server" value="<?php echo $result['lastname'] ?>" name='userLastname'>
            </div>
            <!-- Input Sex -->
            <div class="input-group mb-3">
                <span class="input-group-text" for="inputGroupSelect01">Sex</span>
                <select class="form-control" id="inputGroupSelect01" name="userSex" required>
                    <?php
                        if($result['sex'] == null){
                    ?>
                    <option value="">-- Chose sex --</option>
                    <option value="1">Male</option>
                    <option value="0">Female</option>
                    <?php
                        }else if($result['sex'] == 1){
                    ?>
                    <option value="1">Male</option>
                    <option value="0">Female</option>
                    <?php
                        }else{
                    ?>
                    <option value="0">Female</option>
                    <option value="1">Male</option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <!-- Input Birthday -->
            <div class="input-group mb-3">
                <span class="input-group-text">Birthday</span>
                <!-- Input day birthday -->
                <select class="form-control" id="inputGroupSelect01" name="userBirthdayDay" required>
                    <?php
                        if($result['birthday'] == null){
                    ?>
                        <option value="">Choose day</option>
                        <?php
                            for($i=1; $i < 32; $i++){
                        ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php
                            }
                        ?>
                    <?php
                        }else {
                    ?>
                            <option value="<?php
                                            $timestamp = strtotime($result['birthday']);
                                            $day = date('d', $timestamp);
                                            echo $day
                                        ?>"><?php echo $day ?></option>
                    <?php
                            for($i = 1; $i < 32; $i++){
                                if($i != $day){
                    ?>
                                    <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php
                                }
                            }
                    ?>
                    <?php
                        }
                    ?>
                </select>
                <span class="input-group-text">/</span>
                <!-- Month -->
                <select class="form-control" id="inputGroupSelect01" name="userBirthdayMonth" required>
                    <?php
                        if($result['birthday'] == null){
                    ?>
                        <option value="">Choose month</option>
                    <?php
                            for($i = 1; $i < 13; $i++){
                    ?>
                        <option value="<?php echo $i ?>"><?php echo 'Month '.$i ?></option>
                    <?php
                            }
                    ?>
                    <?php
                        }else{
                    ?>
                            <option value="<?php
                                            $timestamp = strtotime($result['birthday']);
                                            $month = date('m', $timestamp);
                                            echo $month;
                                        ?>"><?php echo 'Month '.$month ?></option>
                            <?php
                                for($i = 1; $i < 13; $i++){
                                    if($i != $month){
                            ?>
                                <option value="<?php echo $i ?>"><?php echo 'Month '.$i ?></option>
                            <?php
                                    }
                                }
                            ?>
                    <?php
                        }
                    ?>
                </select>
                <span class="input-group-text">/</span>
                <!-- Year -->
                <select class="form-control" id="inputGroupSelect01" name="userBirthdayYear" required>
                    <?php
                        $date = getdate();
                        if($result['birthday'] == null){
                    ?>
                        <option value="">Choose year</option>
                        <?php
                            for($i = $date['year']; $i > 1909; $i--){
                        ?>
                            <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php 
                            }
                        ?>
                    <?php
                        }else{
                    ?>
                            <option value="<?php
                                $timestamp = strtotime($result['birthday']);
                                $year = date('Y', $timestamp);
                                echo $year;
                            ?>"><?php echo $year ?></option>
                            <?php
                                for($i = $date['year']; $i > 1909; $i--){
                                    if($i != $year){
                            ?>
                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                            <?php
                                    }
                                }
                            ?>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <!-- Input email -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Email</span>
                <input  
                    type="text" 
                    class="form-control"
                    value="<?php echo $result['email'] ?>"
                    aria-label="Username" 
                    aria-describedby="basic-addon1"
                    name="userEmail"
                    required>
            </div>
            <!-- Input phone -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Phone</span>
                <input  
                    type="text" 
                    class="form-control"
                    value="<?php echo $result['phone'] ?>"
                    aria-label="Username" 
                    aria-describedby="basic-addon1"
                    name="userPhone"
                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                    required>
            </div>
            <!-- Input address -->
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Address</span>
                <input  
                    type="text" 
                    class="form-control"
                    value="<?php echo $result['uaddress'] ?>"
                    aria-label="Username" 
                    aria-describedby="basic-addon1"
                    name="userAddress"
                    required>
            </div>
            <?php
                    }
                }
            ?>
            <div class="input-group">
                <button type="submit" class="btn btn-danger" name="update_profile" value="update_profile">Save</button>
            </div>
        </form>
    </div>

    <!-- Footer Section Begin -->
    <?php
        include './layouts/content/footer.php';
    ?>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- JS file -->
    <?php 
        include './layouts/jsfile.php';
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