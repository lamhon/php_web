<?php
    if(isset($_GET['add-cart'])){
        if(Session::get('userlogin') == true){
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
            $id = $_GET['add-cart'];
            $cart = new Cart(0, $id, 1);

            if(!empty($_SESSION["cart-item"])){
                $cartlst = Session::get('cart-item');
                if(array_key_exists($id, $cartlst['cart'])){
                    $quantity = $cartlst[$id]->get_quantity();
                    $cartlst[$id]->set_quantity($quantity + 1);

                    Session::set('cart-item', $cartlst);
                }else{
                    $cartlst[$id] = $cart;
                    Session::set('cart-item', $cartlst);
                }
            }else{
                $cartlst = array();
                $cartlst[$id] = $cart;
                Session::set('cart-item', $cartlst);
                
            }
            header('Location:shop-cart.php');
        }
    }
?>