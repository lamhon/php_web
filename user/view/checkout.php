<?php
    include '../view/layouts/content/session.php';
?>

<?php
    include '../controller/CartController.php';
    include '../controller/ProductController.php';
    include '../controller/UserController.php';
    include '../controller/BillController.php';

    include '../model/orderinfo.php';
?>

<?php
    $billCon = new BillController();
    $cartCon = new CartController();
    $productCon = new ProductController();

    $sub = 0;
    $total = 0;
    $quan = 0;
    $lstproduct = array();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $count = 0;

        $cart = $cartCon->getCart(Session::get('userId'));
        if($cart){
            while($result = $cart->fetch_assoc()){
                $count++;
            }
        }
        
        if($count > 0){
            $name = $_POST['firstname'] . " " . $_POST['lastname'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $note = $_POST['note'];

            $insertBill = $billCon->insertBill(Session::get('userId'), $name, $address, $phone, $note);
            if($insertBill){
                $idBill = $billCon->getId(Session::get('userId'));
            }

            $cartlst = $cartCon->getCart(Session::get('userId'));
            if($cartlst){
                while($cart = $cartlst->fetch_assoc()){
                    $pro = $productCon->getProductById($cart['idproduct']);
                    if($pro){
                        $res = $pro->fetch_assoc();
                        $productPrice = $res['price'];
                        $orderinfo = new OrderInfo($idBill, $cart['idproduct'], $cart['quantity'], $productPrice);

                        $insertInfo = $billCon->insertInfo($orderinfo);
                        // var_dump($productPrice);
                    }
                }
            }

            $deleteCart = $cartCon->clearCart(Session::get('userId'));
        }
        //var_dump($count);
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
    <title>Sor Decor</title>

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
        <!-- Breadcrumb Begin -->
        <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="coupon__link"><span class="icon_tag_alt"></span> <a href="#">Have a coupon?</a> Click
                    here to enter your code.</h6>
                    <?php
                        if(isset($insertInfo) && isset($deleteCart)){
                            echo '<div class="alert alert-success">Order successfully</div>';
                        }
                    ?>
                </div>
            </div>
            <form method="post" action="checkout.php" class="checkout__form">
                <div class="row">
                    <div class="col-lg-8">
                        <h5>Billing detail</h5>
                        <div class="row">
                            <?php
                                $userCon = new UserController();

                                $getUser = $userCon->getUser(Session::get('userId'));
                                if($getUser){
                                    $user = $getUser->fetch_assoc();
                            ?>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>First Name <span>*</span></p>
                                    <input
                                        required
                                        type="text"
                                        name="firstname"
                                        value="<?php echo $user['firstname']?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Last Name <span>*</span></p>
                                    <input
                                        required
                                        type="text"
                                        name="lastname"
                                        value="<?php echo $user['lastname']?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Address <span>*</span></p>
                                    <input
                                        required
                                        type="text"
                                        name="address"
                                        value="<?php echo $user['uaddress'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Phone <span>*</span></p>
                                    <input
                                        required
                                        type="text"
                                        name="phone"
                                        value="<?php echo $user['phone'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="checkout__form__input">
                                    <p>Email <span>*</span></p>
                                    <input
                                        required
                                        type="text"
                                        name="email"
                                        value="<?php echo $user['email'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="checkout__form__input">
                                    <p>Oder notes</p>
                                    <input 
                                        type="text"
                                        name="note">
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkout__order">
                            <h5>Your order</h5>
                            <div class="checkout__order__product">
                                <ul>
                                    <li>
                                        <span class="top__text">Product</span>
                                        <span class="top__text__right">Total</span>
                                    </li>
                                    <?php
                                        $cartCon = new CartController();
                                        $proCon = new ProductController();

                                        $cartlst = $cartCon->getCart(Session::get('userId'));
                                        if($cartlst){
                                            while($getCart = $cartlst->fetch_assoc()){
                                                $quan++;

                                                $getProduct = $proCon->getProductById($getCart['idproduct']);
                                                if($getProduct){
                                                    $product = $getProduct->fetch_assoc();
                                    ?>
                                        <li><?php echo $product['productname'] ?> (x<?php echo $getCart['quantity'] ?>) <span><?php $sub+= $product['price']; $total+=($product['price']*$getCart['quantity']); echo number_format($product['price']*$getCart['quantity'])?></span></li>
                                    <?php
                                                }
                                            }
                                        }         
                                    ?>
                                </ul>
                            </div>
                            <div class="checkout__order__total">
                                <ul>
                                    <li>Subtotal <span><?php echo number_format($sub);?></span></li>
                                    <li>Total <span><?php echo number_format($total); ?></span></li>
                                </ul>
                            </div>
                            <button type="submit" class="site-btn">Place oder</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
        <!-- Checkout Section End -->

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