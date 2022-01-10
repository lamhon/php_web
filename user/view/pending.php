<?php
    include '../view/layouts/content/session.php';
?>

<?php
    include '../controller/CartController.php';
    include '../controller/BillController.php';
?>

<?php
    $cartCon = new CartController();
    $billCon = new BillController();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sor Decor - Pending</title>

    <?php
        include './layouts/cssfile.php';
    ?>
    <style>
        .filter{
            padding-left: 450px;
            padding-right: 450px
        }

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
                <li  data-filter=".profile"><a href="profile.php">Profile</a></li>
                <li data-filter=".order"><a href="order.php">Your order</a></li>
                <li class="active" data-filter=".pending"><a href="pending.php">Pending order</a></li>
                <li data-filter=".delivered"><a href="delivered.php">Delivered order</a></li>
            </ul>
        </div>
        <div class="mix profile">
            <h5>Pending orders</h5>
        </div>
        
        <p>Manage your orders</p>
        <hr>
        <div class="card-body">
            <table class="tableOrder">
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Receiver</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Note</th>
                    <th>Paid</th>
                    <th>Date order</th>
                </tr>
                <?php
                    $lstBill = $billCon->getBillUser(Session::get('userId'));
                    $i = 0;
                    if($lstBill){
                        while($bill = $lstBill->fetch_assoc()){
                            if($bill['deliverystt'] == 0){
                                $i++;
                ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><a href="order-info.php?id=<?php echo $bill['id'] ?>"><b><?php echo $bill['id'] ?></b></a></td>
                    <td><?php echo $bill['username'] ?></td>
                    <td><?php echo $bill['useraddress'] ?></td>
                    <td><?php echo $bill['phone'] ?></td>
                    <td><?php echo $bill['note'] ?></td>
                    <td>
                        <?php
                            if($bill['paid'] == 0){
                                echo '<p style="color: red;">unpaid</p>';
                            }else{
                                echo '<p style="color: green;">paid</p>';
                            }
                        ?>
                    </td>
                    <td><?php echo $bill['dateorder'] ?></td>
                </tr>
                <?php
                            }
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