<?php
    include_once '../../db/dbconnect.php';
?>

<?php
    class BillController{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function insertBill($userid, $name, $address, $phone, $note){
            $query = "INSERT INTO tbl_orderbill(userid, username, useraddress, phone, note, paid, deliverystt) VALUES ('$userid', '$name', '$address', '$phone', '$note', 0, 0)";
            $result = $this->db->insert($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        public function getId($userid){
            $query = "SELECT * FROM tbl_orderbill WHERE userid = $userid ORDER BY id DESC LIMIT 1";
            $result = $this->db->select($query);

            if($result){
                $res = $result->fetch_assoc();
                $id = $res['id'];
            }
            return $id;
        }

        public function insertInfo($orderinfo){
            $orderid = intval($orderinfo->get_orderid());
            $productid = intval($orderinfo->get_productid());
            $quantity = intval($orderinfo->get_quantity());
            $price = floatval($orderinfo->get_price());

            $query = "INSERT INTO tbl_orderinfo(orderid, productid, quantity, price) VALUES ($orderid, $productid, $quantity, $price)";
        
            $result = $this->db->insert($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }
    }
?>