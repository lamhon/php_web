<?php
    if(isset($_GET['add-cart'])){
        if(Session::get('userId') != null){
            $id = $_GET['add-cart'];

            $productCon = new ProductController();
            $productRes = $productCon->getProductById($id);
            if($productRes){
                while($res = $productRes->fetch_assoc()){
                    $cart = new Cart(Session::get('userId'), $id, 1);
    
                    $cartCon = new CartController();
                    $cartCon->insertItem($cart);
                }
            }
        }else{
            header("Location:login.php");
        }
    }
?>