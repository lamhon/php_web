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

    if(!isset($_GET['id']) || ($_GET['id'] == NULL )){
        echo "<script>window.location = 'index.php'</script>";
    }else{
        $id = $_GET['id'];
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
    <title>Sor Decor - Order Information</title>

    <?php
        include './layouts/cssfile.php';
    ?>
    <style>
        .container-mock{
            padding: 10px 200px 50px 200px;
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

        td img{
            width: 150px;
            height: 175px;
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
        <div class="mix profile">
            <h5>OrderID: <b><?php echo $_GET['id']; ?></b></h5>
        </div>
        <hr>
        <div class="card-body">
            <table class="tableOrder">
                <tr>
                    <th>No</th>
                    <th>Product name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                <?php
                    $lstBill = $billCon->getBillInfo($_GET['id']);
                    $i = 0;
                    if($lstBill){
                        while($bill = $lstBill->fetch_assoc()){
                            $i++;

                            $getProduct = $productCon->getProductById($bill['productid']);
                            $product = $getProduct->fetch_assoc();
                ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><a href="product-detail.php?productid=<?php echo $bill['productid'] ?>"><b><?php echo $product['productname'] ?></b></a></td>
                        <td><img src="../../public/<?php echo $product['img'] ?>" alt="img"></td>
                        <td><?php echo number_format($product['price']) ?></td>
                        <td><?php echo $bill['quantity'] ?></td>
                        <td><?php echo number_format($product['price'] * $bill['quantity']) ?></td>
                    </tr>
                <?php
                        }
                    }
                ?>
            </table>
        </div>
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