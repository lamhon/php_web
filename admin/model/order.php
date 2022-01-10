<?php
    include_once '../../db/dbconnect.php';
?>

<?php
    class Order{
        private $id;
        private $userid;
        private $username;
        private $useraddress;
        private $phone;
        private $note;
        private $paid;
        private $dateorder;
        private $deliverystt;
        private $deliverydate;

        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        //Setter
        public function set_userId($userid){
            $this->userid = $userid;
        }
        public function set_userName($username){
            $this->username = $username;
        }
        public function set_userAddress($useraddress){
            $this->useraddress = $useraddress;
        }
        public function set_userPhone($phone){
            $this->phone = $phone;
        }
        public function set_note($note){
            $this->note = $note;
        }
        public function set_paid($paid){
            $this->paid = $paid;
        }
        public function set_dateOrder($dateorder){
            $this->dateorder = $dateorder;
        }
        public function set_deliveryStt($deliverystt){
            $this->deliverystt = $deliverystt;
        }
        public function set_deliveryDate($deliverydate){
            $this->deliverydate = $deliverydate;
        }

        //Setter
        public function get_id(){
            return $this->id;
        }
        public function get_userId(){
            return $this->userid;
        }
        public function get_userName(){
            return $this->username;
        }
        public function get_userAddress(){
            return $this->useraddress;
        }
        public function get_userPhone(){
            return $this->phone;
        }
        public function get_note(){
            return $this->note;
        }
        public function get_paid(){
            return $this->paid;
        }
        public function get_dateOrder(){
            return $this->dateorder;
        }
        public function get_deliveryStt(){
            return $this->deliverystt;
        }
        public function get_deliveryDate(){
            return $this->deliverydate;
        }

        //---------- Control ------------//
        public function getlstOrder($deliverystt){
            $query = "SELECT * FROM tbl_orderbill WHERE deliverystt = $deliverystt";
            $result = $this->db->select($query);
            return $result;
        }

        public function changeDeliveryStt($id, $stt){
            $query = "UPDATE tbl_orderbill SET deliverystt = '$stt' WHERE id = '$id'";
            $update = $this->db->update($query);
            return $update;
        }

        public function updateDeliveryDate($id){
            $query = "UPDATE tbl_orderbill SET deliverydate = CURRENT_TIMESTAMP, paid = 1 WHERE id = '$id'";
            $update = $this->db->update($query);
            return $update;
        }

        public function checkOrderid($id){
            $query = "SELECT * FROM tbl_orderbill WHERE id = $id";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        public function getOrderInfo($orderid){
            $query = "SELECT * FROM tbl_orderinfo WHERE orderid = '$orderid'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>