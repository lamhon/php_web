<?php 
    include '../controller/ProductController.php';
    include '../controller/CartController.php';

    include '../model/cart.php';
?>

<?php
    include '../view/layouts/content/session.php';
?>

<?php
    $cartCon = new CartController();
    $productCon = new ProductController();

    $sub = 0;
    $total = 0;

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(Session::get('userlogin') == true){
            $cartlst = $cartCon->getCart(Session::get('userId'));

            if($cartlst){
                while($result = $cartlst->fetch_assoc()){
                    $idQuan = "quantity".$result["idproduct"];

                    $cart = new Cart(Session::get('userId'), $result['idproduct'], $_POST[$idQuan]);

                    if($_POST[$idQuan] > 0){
                        $cartCon->updateItem($cart);
                    }else{
                        $cartCon->deleteItem($cart);
                    }
                }
            }
        }else{
            $cartlst = Session::get('cart-item');

            foreach($cartlst as $product){
                $idQuan = "quantity".$product->get_idProduct();

                if($_POST[$idQuan] > 0){
                    $product->set_quantity($_POST[$idQuan]);
                }else{
                    unset($cartlst[$product->get_idProduct()]);
                    Session::set('cart-item', $cartlst);
                }
            }
        }
        
    }

    if(isset($_GET['action']) && $_GET['action'] == "checkout"){
        $cartList = $cartCon->getCart(Session::get('userId'));
        if(Session::get('userlogin') == true){
            if($cartList){
                while($res = $cartList->fetch_assoc()){
                    $product = $productCon->getProductById($res['idproduct']);
                    if($product){
                        while($result = $product->fetch_assoc()){
                            if($res['quantity'] > $result['quantity']){
                                $alert = '<div class="alert alert-danger">The number of products in stock is not enough</div>';
                            }else{
                                header('Location:checkout.php');
                            }
                        }
                    }
                }
            }
        }else{
            header('Location:login.php');
        }
        
    }

    if(isset($_GET['remove'])){
        if(Session::get('userlogin') == true){
            $cart = new Cart(Session::get('userId'), $_GET['remove'], 0);
            $cartCon->deleteItem($cart);
        }else{
            $cartlst = Session::get('cart-item');

            unset($cartlst[$_GET['remove']]);

            Session::set('cart-item', $cartlst);
            header('Location:shop-cart.php');
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
    <title>Sor Decor</title>

    <?php
        include './layouts/cssfile.php';
    ?>

    <style>
        td img{
            width: 125px;
            height: 150px;
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
        <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <form id="my_form" method="post" action="">
            <div class="container">
                <?php
                    if(isset($alert)){
                        echo $alert;
                    }
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(Session::get('userlogin') == true){
                                            $cartList = $cartCon->getCart(Session::get('userId'));
                                            if($cartList){
                                                while($res = $cartList->fetch_assoc()){
                                                    $product = $productCon->getProductById($res['idproduct']);
                                                    if($product){
                                                        while($result = $product->fetch_assoc()){
                                    ?>
                                                            <tr>
                                                                <td class="cart__product__item">
                                                                    <img src="../../public/<?php echo $result['img'] ?>" alt="">
                                                                    <div class="cart__product__item__title">
                                                                        <h6><?php echo $result['productname'] ?></h6>
                                                                        <div class="rating">
                                                                            <p name="id<?php echo $result['id'] ?>"><?php echo $result['id'] ?></p>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="cart__price">
                                                                    <?php
                                                                        $sub += $result['price'];
                                                                        echo number_format($result['price']);
                                                                    ?>
                                                                </td>
                                                                <td class="cart__quantity">
                                                                    <div class="pro-qty">
                                                                        <input 
                                                                            type="text" 
                                                                            value="<?php
                                                                                        $total += $result['price']*$res['quantity'];
                                                                                        echo $res['quantity'];
                                                                                    ?>"
                                                                            onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                            name="<?php echo "quantity".$result['id'] ?>">
                                                                    </div>
                                                                </td>
                                                                <td class="cart__total">
                                                                    <?php
                                                                        $pr = $result['price'];
                                                                        $quan = $res['quantity'];

                                                                        echo number_format($pr * $quan);
                                                                    ?>
                                                                </td>
                                                                <td class="cart__close"><a href="?remove=<?php echo $result['id'] ?>"><span class="icon_close"></a></span></td>
                                                            </tr>
                                    <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }else{
                                            $data['cart'] = Session::get('cart-item');
                                            foreach($data['cart'] as $product){
                                                $getProduct = $productCon->getProductById($product->get_idProduct());
                                                if($getProduct){
                                                    $productinfo = $getProduct->fetch_assoc();
                                    ?>
                                                    <tr>
                                                        <td class="cart__product__item">
                                                            <img src="../../public/<?php echo $productinfo['img'] ?>" alt="">
                                                            <div class="cart__product__item__title">
                                                                <h6><?php echo $productinfo['productname'] ?></h6>
                                                                <div class="rating">
                                                                    <p name="id<?php echo $productinfo['id'] ?>"><?php echo $productinfo['id'] ?></p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="cart__price">
                                                            <?php
                                                                $sub += $productinfo['price'];
                                                                echo number_format($productinfo['price']);
                                                            ?>
                                                        </td>
                                                        <td class="cart__quantity">
                                                            <div class="pro-qty">
                                                                <input 
                                                                    type="text" 
                                                                    value="<?php
                                                                                $total += $productinfo['price'] * $product->get_quantity();
                                                                                echo $product->get_quantity();
                                                                            ?>"
                                                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                    name="<?php echo "quantity".$productinfo['id'] ?>">
                                                            </div>
                                                        </td>
                                                        <td class="cart__total">
                                                            <?php
                                                                $pr = $productinfo['price'];
                                                                $quan = $product->get_quantity();
                                                                echo number_format($pr * $quan);
                                                            ?>
                                                        </td>
                                                        <td class="cart__close"><a href="?remove=<?php echo $productinfo['id'] ?>"><span class="icon_close"></a></span></td>
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
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="cart__btn">
                            <a href="#">Continue Shopping</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="cart__btn update__btn">
                            <a 
                                href="javascript:{}"
                                onclick="document.getElementById('my_form').submit();">
                                <span class="icon_loading"></span> Update cart</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="discount__content">
                            <h6>Discount codes</h6>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">Apply</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-2">
                        <div class="cart__total__procced">
                            <h6>Cart total</h6>
                            <ul>
                                <li>Subtotal <span><?php echo number_format($sub); ?></span></li>
                                <li>Total <span><?php echo number_format($total); ?></span></li>
                            </ul>
                            <a href="shop-cart.php?action=checkout" class="primary-btn">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- Shop Cart Section End -->

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