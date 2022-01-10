<?php
    include_once '../model/order.php';
    include_once '../model/orderinfo.php';
    include_once '../model/cart.php';
    include_once '../model/product.php';
?>

<?php
    class BillController{
        private $orderMo;
        private $infoMo;
        private $cartMo;
        private $productMo;

        public function __construct(){
            $this->orderMo = new Order();
            $this->infoMo = new OrderInfo();
            $this->cartMo = new Cart();
            $this->productMo = new Product();
        }

        public function Switch($action){
            switch ($action){
                case "order":
                    $count = 0;

                    $cartlst = $this->cartMo->getCart(Session::get('userId'));
                    if($cartlst){
                        while($result = $cartlst->fetch_assoc()){
                            $count++;
                        }
                    }
                    
                    if($count > 0){
                        $name = $_POST['firstname'] . " " . $_POST['lastname'];
                        $address = $_POST['address'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $note = $_POST['note'];

                        $insertBill = $this->orderMo->insertBill(Session::get('userId'), $name, $address, $phone, $note);
                        if($insertBill){
                            $idBill = $this->orderMo->getId(Session::get('userId'));
                        }

                        if($cartlst){
                            while($cart = $cartlst->fetch_assoc()){
                                $pro = $this->productMo->getProductById($cart['idproduct']);
                                if($pro){
                                    $res = $pro->fetch_assoc();

                                    // $inStock = $res['quantity'];
                                    // $buyQuan = $cart['quantity'];
                                    // $updateQuan = $inStock - $buyQuan;


                                    $productPrice = $res['price'];

                                    $infoMo->set_orderid($idBill);
                                    $infoMo->set_productid($cart['idproduct']);
                                    $infoMo->set_quantity($cart['quantity']);
                                    $infoMo->set_price($productPrice);

                                    $insertInfo = $this->infoMo->insertInfo($infoMo);
                                    // $updateQuan = $this->productMo->updateQuantity($cart['idproduct'], $updateQuan);
                                    // var_dump($productPrice);
                                }
                            }
                        }

                        $deleteCart = $this->cartMo->clearCart(Session::get('userId'));

                        
                        return '<div class="alert alert-success">Order successfully</div>';
                        
                    }
                    break;
                case "feedback":
                    $lstInfo = $this->infoMo->getBillInfo($_GET['ratebill']);
                    if($lstInfo){
                        while($info = $lstInfo->fetch_assoc()){
                            $getProduct = $this->productMo->getProductById($info['productid']);
                            $product = $getProduct->fetch_assoc();
            
                            if(!isset($_POST['rate'.$product['id']])){
                                $rate = '';
                            }else{
                                $rate = $_POST['rate'.$product['id']];
                            }
            
                            if($_POST["btnSubmit"] == 'product'.$product['id']){
                                $fileimg = 'image'.$product['id'];
                                $insertFeedback = $this->productMo->insertFeedback($info['id'], Session::get('userId'), $product['id'], $rate, $_POST['feedback'.$product['id']], $_FILES[$fileimg], $fileimg);
                            }
                        }
                    }
                    break;
            }
        }

        public function getBillUser($idUser){
            $getBill = $this->orderMo->getBillUser($idUser);
            return $getBill;
        }

        public function getBillInfo($idBill){
            $getInfo = $this->infoMo->getBillInfo($idBill);
            return $getInfo;
        }

        public function getProductRate($billId){
            $getRate = $this->infoMo->getProductRate($billId);
            return $getRate;
        }

        public function checkFeedback($billId){
            $check = $this->productMo->checkFeedback($billId);
            return $check;
        }
    }
?>