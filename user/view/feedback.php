<?php
    include '../view/layouts/content/session.php';
?>

<?php
    include '../controller/CartController.php';
    include '../controller/BillController.php';
    include '../controller/ProductController.php';
?>

<?php
    $cartCon = new CartController();
    $billCon = new BillController();
    $productCon = new ProductController();
    

    if(!isset($_GET['ratebill']) || ($_GET['ratebill'] == NULL)){
        echo "<script>window.location = 'delivered.php'</script>";
    }else{
        if($productCon->checkIdBill($_GET['ratebill'], Session::get('userId'))){
            $id = $_GET['ratebill'];
        }else{
            echo "<script>window.location = 'delivered.php'</script>";
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $insertFeedback = $billCon->Switch("feedback");
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
    <title>Sor Decor - Feedback</title>

    <?php
        include './layouts/cssfile.php';
    ?>
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;    
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;  
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }

        .filter{
            padding-left: 450px;
            padding-right: 450px
        }

        .container-mock{
            padding: 10px 600px 50px 600px;
        }

        .input-group span{
            margin-left: 5px;
            margin-right: 5px;
        }

        .input-group button{
            margin-left: 5px;
        }

        .tableOrder {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        .tableOrder td, .tableOrder th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .tableOrder tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tableOrder tr:hover {
            background-color: #ddd;
        }

        .tableOrder th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #ca1515;
            color: white;
        }
        
        .input-group img{
            height: 220px;
            width: 180px;
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
        <?php
            if(isset($insertFeedback)){
                echo $insertFeedback;
            }
        ?>
        <?php
            $lstInfo = $billCon->getProductRate($_GET['ratebill']);
            if($lstInfo){
                while($info = $lstInfo->fetch_assoc()){
                    $getProduct = $productCon->getProductById($info['productid']);
                    $product = $getProduct->fetch_assoc();
        ?>
        <form class="row g-3" enctype="multipart/form-data" method="POST">
            
            <div class="input-group mb-3">
                <a href="product-detail.php?productid=<?php echo $product['id'] ?>"><h3><?php echo $product['productname'] ?></h3></a>
            </div>
            <div class="input-group mb-3">
                <img src="../../public/<?php echo $product['img'] ?>" alt="">
            </div>
            <div class="input-group mb-3">
                <label for="inputAddress" class="form-label">Price: <b><?php echo number_format($info['price']) ?></b></label>
            </div>
            <div class="input-group mb-3">
                <label for="inputAddress2" class="form-label">Quantity: <?php echo $info['quantity'] ?></label>
            </div>
            <div class="input-group mb-3">
                <label for="inputCity" class="form-label">Total: <b><?php echo number_format($info['price'] * $info['quantity']) ?></b></label>
            </div>
            <div class="input-group mb-3">
                <textarea
                    placeholder="Your feedback"
                    class="form-control"
                    id="exampleFormControlTextarea1"
                    rows="3"
                    name="feedback<?php echo $product['id'] ?>"></textarea>
            </div>
            <div class="input-group mp3">
                <label for="inputImg" class="form-label">Image: </label>
                <input id="inputImg" type="file" name="image<?php echo $product['id'] ?>" required="required">
            </div>
            <div class="input-group mb-3 rate">
                <input type="radio" id="<?php echo $product['id'] ?>star5" name="rate<?php echo $product['id'] ?>" value="5" />
                <label for="<?php echo $product['id'] ?>star5" title="5 stars">5 stars</label>
                <input type="radio" id="<?php echo $product['id'] ?>star4" name="rate<?php echo $product['id'] ?>" value="4" />
                <label for="<?php echo $product['id'] ?>star4" title="4 stars">4 stars</label>
                <input type="radio" id="<?php echo $product['id'] ?>star3" name="rate<?php echo $product['id'] ?>" value="3" />
                <label for="<?php echo $product['id'] ?>star3" title="3 stars">3 stars</label>
                <input type="radio" id="<?php echo $product['id'] ?>star2" name="rate<?php echo $product['id'] ?>" value="2" />
                <label for="<?php echo $product['id'] ?>star2" title="2 stars">2 stars</label>
                <input type="radio" id="<?php echo $product['id'] ?>star1" name="rate<?php echo $product['id'] ?>" value="1" />
                <label for="<?php echo $product['id'] ?>star1" title="1 stars">1 star</label>
            </div>
            <div class="input-group">
                <button type="submit" name="btnSubmit" class="btn btn-primary" value="product<?php echo $product['id'] ?>">Send</button>
            </div>
        </form>
        <hr>
        <br/>
        <?php
                }
            }
        ?>
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