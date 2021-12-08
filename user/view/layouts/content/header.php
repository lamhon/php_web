<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="./index.html"><img src="./public/client/img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="#">Women’s</a></li>
                        <li><a href="#">Men’s</a></li>
                        <li><a href="index.php?page_layout=shop">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="index.php?page_layout=product-details">Product Details</a></li>
                                <li><a href="index.php?page_layout=shop-cart">Shop Cart</a></li>
                                <li><a href="index.php?page_layout=checkout">Checkout</a></li>
                                <li><a href="index.php?page_layout=blog-details">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="index.php?page_layout=blog">Blog</a></li>
                        <li><a href="index.php?page_layout=contact">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    <?php
                        $login_check = Session::get('userlogin');
                        if($login_check == false){

                    ?>
                    <div class="header__right__auth">
                        <a href="login.php">Login</a>
                        <a href="register.php">Register</a>
                    </div>
                    
                    <?php
                        }else{
                    ?>
                    <div class="header__right__auth">
                        <a href="profile.php"><?php echo Session::get('username') ?></a>
                        <a href="?action=logout">Logout</a>
                    </div>
                    <ul class="header__right__widget">
                        <li><span class="icon_search search-switch"></span></li>
                        <li><a href="#"><span class="icon_heart_alt"></span>
                            <div class="tip">2</div>
                        </a></li>
                        <li><a href="#"><span class="icon_bag_alt"></span>
                            <div class="tip">2</div>
                        </a></li>
                    </ul>
                    <?php
                        }
                    ?>
                    
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>