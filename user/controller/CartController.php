<?php
    include_once '../model/cart.php';
    include_once '../model/product.php';
?>

<?php
    class CartController{
        private $cartMo;
        private $productMo;

        public function __construct(){
            $this->cartMo = new Cart();
            $this->productMo = new Product();
        }

        public function Switch($action){
            switch($action){
                case "add-cart":
                    if(Session::get('userlogin') == true){
                        $id = $_GET['add-cart'];
            
                        $productRes = $this->productMo->getProductById($id);
                        if($productRes){
                            $res = $productRes->fetch_assoc();

                            $this->cartMo->set_idUser(Session::get('userId'));
                            $this->cartMo->set_idProduct($id);
                            $this->cartMo->set_quantity(1);

                            $this->cartMo->insertItem($this->cartMo);
                            
                        }
                    }else{
                        $id = $_GET['add-cart'];

                        $this->cartMo->set_idUser(0);
                        $this->cartMo->set_idProduct($id);
                        $this->cartMo->set_quantity(1);
            
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
                            $cartlst[$id] = $this->cartMo;
                            Session::set('cart-item', $cartlst);
                            
                        }
                        header('Location:shop-cart.php');
                    }
                    break;
                case "update_cart":
                    if(Session::get('userlogin') == true){
                        $cartlst = $this->cartMo->getCart(Session::get('userId'));
            
                        if($cartlst){
                            while($result = $cartlst->fetch_assoc()){
                                $idQuan = "quantity".$result["idproduct"];
            
                                $this->cartMo->set_idUser(Session::get('userId'));
                                $this->cartMo->set_idProduct($result['idproduct']);
                                $this->cartMo->set_quantity($_POST[$idQuan]);
                                
                                if($_POST[$idQuan] > 0){
                                    $this->cartMo->updateItem($this->cartMo);
                                }else{
                                    $this->cartMo->deleteItem($this->cartMo);
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
                    break;
                case "checkout":
                    $check = true;
                    $cartList = $this->cartMo->getCart(Session::get('userId'));
                    if(Session::get('userlogin') == true){
                        if($cartList){
                            while($cart = $cartList->fetch_assoc()){
                                $product = $this->productMo->getProductById($cart['idproduct']);
                                if($product){
                                    $getProduct = $product->fetch_assoc();
                                    if($cart['quantity'] > $getProduct['quantity']){
                                        $check = false;
                                    }
                                }
                            }
                            return $check;
                        }
                    }else{
                        header('Location:login.php');
                    }
                    break;
                case "remove":
                    if(Session::get('userlogin') == true){
                        $this->cartMo->set_idUser(Session::get('userId'));
                        $this->cartMo->set_idProduct($_GET['remove']);

                        $this->cartMo->deleteItem($this->cartMo);
                    }else{
                        $cartlst = Session::get('cart-item');
            
                        unset($cartlst[$_GET['remove']]);
            
                        Session::set('cart-item', $cartlst);
                        header('Location:shop-cart.php');
                    }
                    break;
            }
        }

        public function getCart($userId){
            $cart = $this->cartMo->getCart($userId);
            return $cart;
        }
    }
?>