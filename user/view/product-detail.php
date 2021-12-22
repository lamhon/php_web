<?php
    include '../view/layouts/content/session.php';

    include '../controller/ProductController.php';
    include '../controller/CategoryController.php';
    include '../controller/CartController.php';
    include '../controller/UserController.php';
?>

<?php
    $productCon = new ProductController();
    $cateCon = new CategoryController();
    $userCon = new UserController();

    if(!isset($_GET['productid']) || ($_GET['productid'] == NULL )){
        echo "<script>window.location = 'index.php'</script>";
    }else{
        $id = $_GET['productid'];
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
        @media (min-width: 0) {
            .g-mr-15 {
                margin-right: 1.07143rem !important;
            }
        }
        @media (min-width: 0){
            .g-mt-3 {
                margin-top: 0.21429rem !important;
            }
        }

        .g-height-50 {
            height: 50px;
        }

        .g-width-50 {
            width: 50px !important;
        }

        @media (min-width: 0){
            .g-pa-30 {
                padding: 2.14286rem !important;
            }
        }

        .g-bg-secondary {
            background-color: #fafafa !important;
        }

        .u-shadow-v18 {
            box-shadow: 0 5px 10px -6px rgba(0, 0, 0, 0.15);
        }

        .g-color-gray-dark-v4 {
            color: #777 !important;
        }

        .g-font-size-12 {
            font-size: 0.85714rem !important;
        }

        .media-comment {
            margin-top:20px
        }

        .media-body img{
            height: 210px;
            width: 190px;
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


    <?php
        $getProduct = $productCon->getProductById($id);
        if($getProduct){
            while($result = $getProduct->fetch_assoc()){
    ?>
    <!-- body -->
        <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="index.php"><i class="fa fa-home"></i> Home</a>
                        <a href="#">
                            <?php
                                $getCate = $cateCon->getCategory($result['categoryid']);
                                if($getCate){
                                    while($cateName = $getCate->fetch_assoc()){
                                        $name = $cateName['categoryname'];
                                        echo $name.' ';
                                    }
                                }
                            ?>
                        </a>
                        <span><?php echo $result['productname'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                <img data-hash="product-1" class="product__big__img" src="../../public/<?php echo $result['img'] ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3>
                            <?php echo $result['productname'] ?>
                            <span>
                                <?php
                                    $getCate = $cateCon->getCategory($result['categoryid']);
                                    if($getCate){
                                        while($cateName = $getCate->fetch_assoc()){
                                            $name = $cateName['categoryname'];
                                            echo $name.' ';
                                        }
                                    }
                                ?>
                            </span>
                        </h3>
                        <div class="rating">
                            <?php
                                    $rate = $productCon->getRate($result['id']);
                                    $rate = round($rate, 1);
                                    $countstar = intval($rate);
                                    $starodd = $rate - $countstar;
                                    if($countstar == 0 && $starodd == 0){

                                    }else if($starodd < 5){
                                        for($i = 0; $i < $countstar; $i++){
                                ?>
                                            <i class="fa fa-star"></i>
                                <?php
                                        }
                                ?>
                                            <i class="far fa-star"></i> 
                                <?php
                                    }else if($starodd == 5){
                                        for($i = 0; $i < $countstar; $i++){
                                ?>
                                            <i class="fa fa-star"></i>
                                <?php
                                        }
                                ?>
                                        <i class="fas fa-star-half"></i>
                                <?php
                                    }else if($starodd > 5){
                                        for($i = 0; $i < $countstar+1; $i++){
                                ?>
                                            <i class="fa fa-star"></i>
                                <?php
                                        }
                                        $nullStar = 5 - ($countstar + 1);
                                        for($i = 0; $i <$nullStar; $i++){
                                ?>
                                            <i class="far fa-star"></i>
                                <?php
                                        }
                                    }
                                ?>
                            <?php
                                $ratequan = $productCon->getReviewQuantity($result['id']);
                                if($ratequan == 1){
                            ?>
                                <span>( <?php echo $ratequan; ?> review )</span>
                            <?php
                                }else{
                            ?>
                                <span>( <?php echo $ratequan ?> reviews )</span>
                            <?php
                                }
                            ?>
                        </div>
                        <?php
                            if($result['sale'] != 0){
                        ?>
                            <div class="product__details__price">
                                <script>
                                    let price = new Number(<?php echo $price = ($result['price'] - ($result['price'] * $result['sale'])/100) ?>);
                                    var myObj = {
                                        style: "currency",
                                        currency: "VND"
                                    }
                                            
                                    document.write(price.toLocaleString("vi-VN", myObj));
                                </script>
                                <span>
                                    <script>
                                        let oldPrice = new Number(<?php echo $result['price'] ?>);
                                        var myObj = {
                                            style: "currency",
                                            currency: "VND"
                                        }

                                        document.write(oldPrice.toLocaleString("vi-VN", myObj));
                                    </script>
                                </span>
                            </div>
                        <?php
                            }else{
                        ?>
                            <div class="product__details__price">
                                <script>
                                        let price = new Number(<?php echo $result['price'] ?>);
                                        var myObj = {
                                            style: "currency",
                                            currency: "VND"
                                        }

                                        document.write(price.toLocaleString("vi-VN", myObj));
                                </script>
                            </div>
                        <?php
                            }
                        ?>
                        
                        <p><?php echo $result['info'] ?></p>
                        <div class="product__details__button">
                            <div class="quantity">
                                <span>Quantity:</span>
                                <div class="pro-qty">
                                    <input 
                                        type="text" 
                                        value="1"
                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                        >
                                </div>
                            </div>
                            <a href="#" class="cart-btn"><span class="icon_bag_alt"></span> Add to cart</a>
                            <!-- <ul>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
                            </ul> -->
                        </div>
                        <div class="product__details__widget">
                            <ul>
                                <li>
                                    <span>Stock:</span>
                                    <div class="stock__checkbox">
                                        <label>
                                            <?php echo $result['quantity'] ?>
                                            <!-- <input type="checkbox" id="stockin">
                                            <span class="checkmark"></span> -->
                                        </label>
                                    </div>
                                </li>
                                <!-- <li>
                                    <span>Available color:</span>
                                    <div class="color__checkbox">
                                        <label for="red">
                                            <input type="radio" name="color__radio" id="red" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label for="black">
                                            <input type="radio" name="color__radio" id="black">
                                            <span class="checkmark black-bg"></span>
                                        </label>
                                        <label for="grey">
                                            <input type="radio" name="color__radio" id="grey">
                                            <span class="checkmark grey-bg"></span>
                                        </label>
                                    </div>
                                </li> -->
                                <!-- <li>
                                    <span>Available size:</span>
                                    <div class="size__btn">
                                        <label for="xs-btn" class="active">
                                            <input type="radio" id="xs-btn">
                                            xs
                                        </label>
                                        <label for="s-btn">
                                            <input type="radio" id="s-btn">
                                            s
                                        </label>
                                        <label for="m-btn">
                                            <input type="radio" id="m-btn">
                                            m
                                        </label>
                                        <label for="l-btn">
                                            <input type="radio" id="l-btn">
                                            l
                                        </label>
                                    </div>
                                </li> -->
                                <!-- <li>
                                    <span>Promotions:</span>
                                    <p>Free shipping</p>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                            </li>
                            <li class="nav-item">
                                <?php
                                    if($ratequan == 1){
                                ?>
                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Review ( 1 )</a>
                                <?php
                                    }else{
                                ?>
                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( <?php echo $ratequan; ?> )</a>
                                <?php
                                    }
                                ?>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <h6>Description</h6>
                                <p><?php echo $result['descript'] ?></p>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <h6>Specification</h6>
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                    quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                    Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                    voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                consequat massa quis enim.</p>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                quis, sem.</p>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <?php
                                    $lstReviews = $productCon->getReview($_GET['productid']);
                                    if($lstReviews){
                                        while($comment = $lstReviews->fetch_assoc()){
                                            $getUser = $userCon->getUser(Session::get('userId'));
                                            $user = $getUser->fetch_assoc();
                                ?>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="media g-mb-30 media-comment">
                                                    <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Image Description">
                                                    <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                                        <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                                            <h5 class="h5 g-color-gray-dark-v1 mb-0"><?php echo $user['firstname'].' '.$user['lastname'] ?></h5>
                                                            <?php
                                                                $today = strtotime(date("Y/m/d"));
                                                                $dateReview = $comment['feed_date'];
                                                                $dt = new DateTime($dateReview);
                                                                $dateReview = strtotime($dt->format('Y/m/d'));
                                                                $datediff = abs($today - $dateReview);
                                                                $datediff = floor($datediff/(60*60*24));

                                                                if($datediff > 30){
                                                            ?>
                                                                <span class="g-color-gray-dark-v4 g-font-size-12"><?php echo date("d/m/Y",$dateReview); ?></span>
                                                            <?php
                                                                }else if($datediff <= 30 && $datediff > 1){
                                                            ?>
                                                                    <span class="g-color-gray-dark-v4 g-font-size-12"><?php echo $datediff.' days ago'; ?></span>
                                                            <?php
                                                                    // echo $datediff;
                                                                }else if($datediff == 1){
                                                            ?>
                                                                <span class="g-color-gray-dark-v4 g-font-size-12"><?php echo $datediff.' day ago'; ?></span>
                                                            <?php
                                                                }else{
                                                                    $datediff = abs($today - $dateReview);
                                                                    if($datediff < 3600){
                                                                         $time = floor($datediff/60);
                                                            ?>
                                                                <span class="g-color-gray-dark-v4 g-font-size-12"><?php echo $time.' minutes ago'; ?></span>
                                                            <?php
                                                                    }else{
                                                                         $time = floor($datediff/(60*60));
                                                            ?>
                                                                <span class="g-color-gray-dark-v4 g-font-size-12"><?php echo $time.' hours ago'; ?></span>
                                                            <?php
                                                                    }
                                                                }
                                                            ?>
                                                            <!-- <span class="g-color-gray-dark-v4 g-font-size-12">5 days ago</span> -->
                                                            <?php
                                                                $rate = $productCon->getRate($result['id']);
                                                                $rate = round($rate, 1);
                                                                $countstar = intval($rate);
                                                                $starodd = $rate - $countstar;
                                                                if($starodd < 5){
                                                                    for($i = 0; $i < $countstar; $i++){
                                                            ?>
                                                                        <i class="fa fa-star"></i>
                                                            <?php
                                                                    }
                                                            ?>
                                                                        <i class="far fa-star"></i> 
                                                            <?php
                                                                }else if($starodd == 5){
                                                                    for($i = 0; $i < $countstar; $i++){
                                                            ?>
                                                                        <i class="fa fa-star"></i>
                                                            <?php
                                                                    }
                                                            ?>
                                                                    <i class="fas fa-star-half"></i>
                                                            <?php
                                                                }else if($starodd > 5){
                                                                    for($i = 0; $i < $countstar+1; $i++){
                                                            ?>
                                                                        <i class="fa fa-star"></i>
                                                            <?php
                                                                    }
                                                                    $nullStar = 5 - ($countstar + 1);
                                                                    for($i = 0; $i <$nullStar; $i++){
                                                            ?>
                                                                        <i class="far fa-star"></i>
                                                            <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </div>
                                                        <p><?php echo $comment['mess'] ?></p>
                                                        <br>
                                                        <img src="../../public/<?php echo $comment['img'] ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    }
                }
            ?>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="related__title">
                        <h5>RELATED PRODUCTS</h5>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="./assets/img/product/related/rp-1.jpg">
                            <div class="label new">New</div>
                            <ul class="product__hover">
                                <li><a href="./assets/img/product/related/rp-1.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Buttons tweed blazer</a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="./assets/img/product/related/rp-2.jpg">
                            <ul class="product__hover">
                                <li><a href="./assets/img/product/related/rp-2.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Flowy striped skirt</a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 49.0</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="./assets/img/product/related/rp-3.jpg">
                            <div class="label stockout">out of stock</div>
                            <ul class="product__hover">
                                <li><a href="./assets/img/product/related/rp-3.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Cotton T-Shirt</a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="./assets/img/product/related/rp-4.jpg">
                            <ul class="product__hover">
                                <li><a href="./assets/img/product/related/rp-4.jpg" class="image-popup"><span class="arrow_expand"></span></a></li>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Slim striped pocket shirt</a></h6>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="product__price">$ 59.0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

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