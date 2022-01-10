<?php
    include_once '../../db/dbconnect.php';
?>

<?php
    class OrderInfo{
        private $id;
        private $orderid;
        private $productid;
        private $quantity;
        private $price;
        private $feedback;

        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        //get method
        public function get_id(){
            return $this->this->id;
        }

        public function get_orderid(){
            return $this->orderid;
        }

        public function get_productid(){
            return $this->productid;
        }

        public function get_quantity(){
            return $this->quantity;
        }

        public function get_price(){
            return $this->price;
        }

        public function get_feedback(){
            return $this->feedback;
        }

        //set method
        public function set_orderid($orderid){
            $this->orderid = $orderid;
        }

        public function set_productid($productid){
            $this->productid = $productid;
        }

        public function set_quantity($quantity){
            $this->quantity = $quantity;
        }

        public function set_price($price){
            $this->price = $price;
        }

        public function set_feedback($feedback){
            $this->feedback = $feedback;
        }

        //------Control------//
        public function insertInfo($orderid, $productid, $quantity, $price){
            $query = "INSERT INTO tbl_orderinfo(orderid, productid, quantity, price) VALUES ($orderid, $productid, $quantity, $price)";
        
            $result = $this->db->insert($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        public function getBillInfo($billid){
            $query = "SELECT * FROM tbl_orderinfo WHERE orderid = $billid";
            $result = $this->db->select($query);
            return $result;
        }

        public function getProductRate($billid){
            $query = "SELECT * FROM tbl_orderinfo WHERE orderid = $billid AND feedback = 0";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>