<?php
    include_once '../../db/dbconnect.php';
?>

<?php
    class OrderController{
        private $db;

        //initialize
        public function __construct(){
            $this->db = new Database();
        }

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
    }
?>