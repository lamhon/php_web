<?php
    include_once '../../db/dbconnect.php';
?>

<?php
    class Cart{
        private $idUser;
        private $idProduct;
        private $quantity;

        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        // Getter
        public function get_idUser(){
            return $this->idUser;
        }

        public function get_idProduct(){
            return $this->idProduct;
        }

        public function get_quantity(){
            return $this->quantity;
        }

        //Setter
        public function set_idUser($idUser){
            $this->idUser = $idUser;
        }

        public function set_idProduct($idProduct){
            $this->idProduct = $idProduct;
        }

        public function set_quantity($quantity){
            $this->quantity = $quantity;
        }

        //------Control------//
        public function getCart($idUser){
            $query = "SELECT * FROM tbl_cart WHERE iduser = '$idUser'";
            $result = $this->db->select($query);
            return $result;
        }

        public function insertItem($cart){
            $iduser = $cart->get_idUser();
            $idproduct = $cart->get_idProduct();
            $quantity = $cart->get_quantity();
            
            $check = $this->checkProduct($idproduct, $iduser);
            if($check > 0){
                $quantity = $check + 1;
    
                $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE iduser = '$iduser' AND idproduct = '$idproduct'";
    
                $result = $this->db->update($query);
                if($result){
                    header("Location:shop-cart.php");
                }else{
                    header("Location:index.php");
                }
                
            }else{
                $query = "INSERT INTO tbl_cart(iduser, idproduct, quantity) VALUES ('$iduser', '$idproduct', '$quantity')";

                $result = $this->db->insert($query);
                if($result){
                    header("Location:shop-cart.php");
                }else{
                    header("Location:index.php");
                }
            }
        }

        public function updateItem($cart){
            $iduser = $cart->get_idUser();
            $idproduct = $cart->get_idProduct();
            $quantity = $cart->get_quantity();

            $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE iduser = '$iduser' AND idproduct = '$idproduct'";
        
            $result = $this->db->update($query);

            if($result){
                header('Location:shop-cart.php');
            }
        }

        public function deleteItem($cart){
            $iduser = $cart->get_idUser();
            $idproduct = $cart->get_idProduct();

            $query = "DELETE FROM tbl_cart WHERE iduser = '$iduser' AND idproduct = '$idproduct'";

            $result = $this->db->delete($query);
            if($result){
                header('Location:shop-cart.php');
            }
        }

        public function clearCart($userid){
            $query = "DELETE FROM tbl_cart WHERE iduser = '$userid'";

            $result = $this->db->delete($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        public function checkProduct($idproduct, $iduser){
            $query = "SELECT * FROM tbl_Cart WHERE idproduct = '$idproduct' AND iduser = '$iduser'";
            $result = $this->db->select($query);
            if($result){
                $result = $result->fetch_assoc();
                if($result['quantity'] > 0){
                    return $result['quantity'];
                }else{
                    return 0;
                }
            }else{
                return 0;
            }  
        }
    }
?>