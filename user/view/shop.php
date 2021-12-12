<?php
    include '../view/layouts/content/session.php';

    include '../controller/CartController.php';
    include '../controller/CategoryController.php';
    include '../controller/ProductController.php';

    include '../model/cart.php';
?>

<?php
    $cateCon = new CategoryController();
    $proCon = new ProductController();
?>

<?php
    include '../view/layouts/content/add-cart.php';
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
        .product__item__pic .label.giadung {
            background: #36a300 !important;
        }

        .product__item__pic .label.postcard {
            background: #111111 !important;
        }

        .product__item__pic .label.trangtri {
            background: #0066bd !important;
        }

        .product__item__pic .label.sale {
            background: #ca1515;
        }

        .product__item__pic .label.quanao {
            background: #864879 !important;
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
        <!-- Shop Section Begin -->
        <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    <?php
                                        $catelst = $cateCon->getAll_category();
                                        if($catelst){
                                            while($cate = $catelst->fetch_assoc()){
                                    ?>
                                        <div class="card">
                                            <div class="card-heading">
                                                <a href="shop.php?cate=<?php echo $cate['id'] ?>"><?php echo $cate['categoryname'] ?></a>
                                            </div>
                                        </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__filter">
                            <form id="form_short" method="get" action="">
                                <div class="section-title">
                                    <h4>Shop by price</h4>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Min</span>
                                    <input 
                                        required
                                        value="0"
                                        type="text"
                                        class="form-control"
                                        placeholder="Min price"
                                        aria-label="Username"
                                        aria-describedby="basic-addon1"
                                        name="minPrice"
                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Max</span>
                                    <input
                                        required=""
                                        value="0"
                                        type="text"
                                        class="form-control"
                                        placeholder="Max price"
                                        aria-label="Username"
                                        aria-describedby="basic-addon1"
                                        name="maxPrice"
                                        onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                                </div>
                                <br>
                                <button type="submit" style="border: 2px solid #ca1515; background-color: white; padding: 3px 12px 3px 12px; font-family: 'Montserrat'">Filter</button>
                            </form>
                        </div>
                        <!-- <div class="sidebar__sizes">
                            <div class="section-title">
                                <h4>Shop by size</h4>
                            </div>
                            <div class="size__list">
                                <label for="xxs">
                                    xxs
                                    <input type="checkbox" id="xxs">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="xs">
                                    xs
                                    <input type="checkbox" id="xs">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="xss">
                                    xs-s
                                    <input type="checkbox" id="xss">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="s">
                                    s
                                    <input type="checkbox" id="s">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="m">
                                    m
                                    <input type="checkbox" id="m">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="ml">
                                    m-l
                                    <input type="checkbox" id="ml">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="l">
                                    l
                                    <input type="checkbox" id="l">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="xl">
                                    xl
                                    <input type="checkbox" id="xl">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div> -->
                        <!-- <div class="sidebar__color">
                            <div class="section-title">
                                <h4>Shop by size</h4>
                            </div>
                            <div class="size__list color__list">
                                <label for="black">
                                    Blacks
                                    <input type="checkbox" id="black">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="whites">
                                    Whites
                                    <input type="checkbox" id="whites">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="reds">
                                    Reds
                                    <input type="checkbox" id="reds">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="greys">
                                    Greys
                                    <input type="checkbox" id="greys">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="blues">
                                    Blues
                                    <input type="checkbox" id="blues">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="beige">
                                    Beige Tones
                                    <input type="checkbox" id="beige">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="greens">
                                    Greens
                                    <input type="checkbox" id="greens">
                                    <span class="checkmark"></span>
                                </label>
                                <label for="yellows">
                                    Yellows
                                    <input type="checkbox" id="yellows">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <?php
                            $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:9;
                            $current_page = !empty($_GET['page'])?$_GET['page']:1;
                            $offset = ($current_page - 1) * $item_per_page;

                            if(isset($_GET['cate'])){
                                $prolst = $proCon->get_Product_Cate_Paging($item_per_page, $offset, $_GET['cate'], 1);
                                $totalRecords = $proCon->get_AllProduct_ByCate($_GET['cate'], 1);
                            }else if(isset($_GET['minPrice']) && isset($_GET['maxPrice'])){
                                $prolst = $proCon->get_Product_Price_Paging($item_per_page, $offset, floatval($_GET['minPrice']), floatval($_GET['maxPrice']), 1);
                                $totalRecords = $proCon->get_AllProduct_ByPrice(floatval($_GET['minPrice']), floatval($_GET['maxPrice']), 1);
                            }else{
                                $prolst = $proCon->get_Product_Paging($item_per_page, $offset, 1);
                                $totalRecords = $proCon->get_AllProduct(1);
                            }

                            $totalRecords = $totalRecords->num_rows;
                            $totalPage = ceil($totalRecords / $item_per_page);

                            if($prolst){
                                while($product = $prolst->fetch_assoc()){
                        ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="product__item sale">
                                    <div class="product__item__pic set-bg" data-setbg="../../public/<?php echo $product['img'] ?>">
                                        <!-- <div class="label">Sale</div> -->
                                        <?php
                                            if($product['categoryid'] == 1){
                                        ?>
                                            <div class="label trangtri">Decorate</div>
                                        <?php
                                            }else if($product['categoryid'] == 2){
                                        ?>
                                            <div class="label postcard">Postcard</div>
                                        <?php
                                            }else if($product['categoryid'] == 3){
                                        ?>
                                            <div class="label quanao">Clothes</div>
                                        <?php
                                            }else if($product['categoryid'] == 4){
                                        ?>
                                            <div class="label giadung">Houseware</div>
                                        <?php
                                            }else if($product['sale'] > 0){
                                        ?>
                                            <div class="label sale">Sale</div>
                                        <?php
                                            }
                                        ?>
                                        <ul class="product__hover">
                                            <li><a href="../../public/<?php echo $product['img'] ?>" class="image-popup"><span class="arrow_expand"></span></a></li>
                                            <li><a href="?add-cart=<?php echo $product['id'] ?>"><span class="icon_bag_alt"></span></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="#"><?php echo $product['productname'] ?></a></h6>
                                        <div class="rating">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <?php
                                            if($product['sale'] > 0){
                                        ?>
                                            <div class="product__price"><?php echo number_format($product['price'] - ($product['price'] * $product['sale']/100)) ?><span><?php echo number_format($product['price']) ?></span></div>
                                        <?php
                                            }else{
                                        ?>
                                            <div class="product__price"><?php echo number_format($product['price'])?></div>
                                        <?php
                                            }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                        <?php
                                }
                            }
                        ?>
                        <div class="col-lg-12 text-center">
                            <div class="pagination__option">
                                <?php
                                    if(isset($_GET['cate'])){
                                        $cateid = $_GET['cate'];
                                        for($num = 1; $num <= $totalPage; $num++){
                                            if($num > $current_page - 3 && $num < $current_page + 3){
                                ?>
                                    <a href="?cate=<?php echo $cateid ?>&per_page<?php echo $item_per_page ?>&page=<?php echo  $num?>"><?php echo  $num?></a>
                                <?php
                                            }
                                        }
                                    }else if(isset($_GET['minprice']) && $_GET['maxprice']){
                                        for($num = 1; $num <= $totalPage; $num++){
                                            if($num > $current_page - 3 && $num < $current_page + 3){
                                                $minPrice = str_replace(array(','), '', $_GET['minPrice']);
                                                $maxPrice = str_replace(array(','), '', $_GET['maxPrice']);
                                ?>
                                    <a href="?minPrice=<?php echo $minPrice ?>&maxPrice=<?php echo $maxPrice ?>&per_page<?php echo $item_per_page ?>&page=<?php echo  $num?>"><?php echo  $num?></a>
                                <?php
                                            }
                                        }
                                    }else{
                                        for($num = 1; $num <= $totalPage; $num++){
                                            if($num > $current_page - 3 && $num < $current_page + 3){
                                ?>
                                    <a href="?per_page<?php echo $item_per_page ?>&page=<?php echo  $num?>"><?php echo $num?></a>
                                <?php
                                            }
                                        }
                                    }
                                ?>
                                <!-- <a href="#">1</a>
                                <a href="#">2</a>
                                <a href="#">3</a>
                                <a href="#"><i class="fa fa-angle-right"></i></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->

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
<!-- Search End -->

<!-- JS file -->
<?php 
    include './layouts/jsfile.php';
?>
<script>
    //Input currency
    $("input[data-type='currency']").on({
        keyup: function() {
        formatCurrency($(this));
        },
        blur: function() { 
        formatCurrency($(this), "blur");
        }
    });

    function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    }

    function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.
        
        // get input value
        var input_val = input.val();
        
        // don't validate empty input
        if (input_val === "") { return; }
        
        // original length
        var original_len = input_val.length;
    
        // initial caret position 
        var caret_pos = input.prop("selectionStart");
        
        // check for decimal
        if (input_val.indexOf(".") >= 0) {
    
        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");
    
        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);
    
        // add commas to left side of number
        left_side = formatNumber(left_side);
    
        // validate right side
        right_side = formatNumber(right_side);
        
        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
            right_side += "00";
        }
        
        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);
    
        // join number by .
        input_val = left_side + "." + right_side;
    
        } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        input_val = input_val;
        
        // final formatting
        if (blur === "blur") {
            input_val += ".00";
        }
        }
        
        // send updated string to input
        input.val(input_val);
    
        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
    }
</script>
</body>

</html>