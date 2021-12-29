<?php
    include '../controller/CartController.php';
    include '../model/cart.php';

    include_once '../../db/dbconnect.php';

    include_once '../../lib/session.php';
    Session::checkUserLogin();
?>

<?php
    class LoginController{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function loginUser($username, $password){
            $cartCon = new CartController();

            $username = mysqli_real_escape_string($this->db::$link, $username);
            $password = mysqli_real_escape_string($this->db::$link, $password);

            $query = "SELECT * FROM tbl_useraccount WHERE username = '$username' AND pwd = '$password'";
            $result = $this->db->select($query);

            if($result != false){

                $value = $result->fetch_assoc();
                if($value['stt'] == 1){
                    Session::set('userlogin', true);
                    Session::set('userId', $value['id']);
                    Session::set('username', $value['username']);

                    

                    if(Session::get('cart-item') != null){
                        $cartlst = $cartCon->getCart($value['id']);
                        $cartSession = Session::get('cart-item');
                        if($cartlst){
                            while($result = $cartlst->fetch_assoc()){
                                foreach($cartSession as $productSession){
                                    if($productSession->get_idProduct() != $result['idproduct']){
                                        $cart = new Cart($value['id'], $productSession->get_idProduct(), $productSession->get_quantity());
                                        $cartCon->insertItem($cart);
                                        unset($cartSession[$productSession->get_idProduct()]);
                                    }
                                }
                            }
                            Session::set('cart-item', null);
                        }
                    }

                    header('Location:index.php');
                    //$alert = '<div class="alert alert-success">Your account is active</div>';
                    //return $alert;
                }else{
                    $alert = '<div class="alert alert-danger">Your account is locked</div>';
                    return $alert;
                }
            }else{
                $alert = '<div class="alert alert-danger">Username or password is wrong!</div>';
                return $alert;
            }
        }
    }
?>