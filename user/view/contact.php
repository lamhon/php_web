<?php
    include '../view/layouts/content/session.php';
?>

<?php
    include '../controller/CartController.php';
    include '../controller/UserController.php';
    include '../controller/MessageController.php';

    include '../model/message.php';
?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(Session::get('userlogin') == true){
                // get user information and then get first name and last name
            $userCon = new UserController();
            $messCon = new MessageController();
            $getUser = $userCon->getUser(Session::get('userId'));

            if($getUser){
                $resUser = $getUser->fetch_assoc();

                $firstname = $resUser['firstname'];
                $lastname = $resUser['lastname'];
                $name = $firstname . ' ' . $lastname;

                $mess = new Message(Session::get('userId'), $name, $resUser['email'], $_POST['message'], 0);

                $insertMess = $messCon->insertMessage($mess);
            }
        }else{
            header("Location:login.php");
        }
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
    <title>Sor Decor - Contact</title>

    <?php
        include './layouts/cssfile.php';
    ?>
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
            <li><a href="#"><span class="icon_heart_alt"></span>
                <div class="tip">2</div>
            </a></li>
            <li><a href="#"><span class="icon_bag_alt"></span>
                <div class="tip">2</div>
            </a></li>
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
    <!-- Header Section End -->

    <!-- body -->
       <!-- Contact Section Begin -->
       <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__content">
                        <div class="contact__address">
                            <h5>Contact info</h5>
                            <ul>
                                <li>
                                    <h6><i class="fa fa-map-marker"></i> Address</h6>
                                    <p>D2, Binh Thanh, Ho Chi Minh City</p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-phone"></i> Phone</h6>
                                    <p><span>0345071246</span><span>125-668-886</span></p>
                                </li>
                                <li>
                                    <h6><i class="fa fa-headphones"></i> Support</h6>
                                    <p>hoangtunglamltd@gmail.com</p>
                                </li>
                            </ul>
                        </div>
                        <div class="contact__form">
                            <?php
                                if(isset($insertMess)){
                                    echo $insertMess;
                                }
                            ?>
                            <h5>SEND MESSAGE</h5>
                            <form action="contact.php" method="post">
                                <?php
                                    if(Session::get('userlogin') == true){
                                ?>
                                    <textarea placeholder="Message" name="message"></textarea>
                                <?php
                                    }else{
                                ?>
                                    <input type="text" placeholder="Name" name="name">
                                    <input type="text" placeholder="Email" name="email">
                                    <textarea placeholder="Message" name="message"></textarea>
                                <?php
                                    }
                                ?>
                                <button type="submit" class="site-btn">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__map">
                        <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d48158.305462977965!2d-74.13283844036356!3d41.02757295168286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2e440473470d7%3A0xcaf503ca2ee57958!2sSaddle%20River%2C%20NJ%2007458%2C%20USA!5e0!3m2!1sen!2sbd!4v1575917275626!5m2!1sen!2sbd"
                        height="780" style="border:0" allowfullscreen="">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

    <!-- end body -->
    
<!-- Services Section End -->

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
</body>

</html>