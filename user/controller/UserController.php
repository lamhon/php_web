<?php
    include_once '../../db/dbconnect.php';
?>


<?php
    class UserController{
        private $db;

        //initialize
        public function __construct(){
            $this->db = new Database();
        }
        public function getUser($id){
            $query = "SELECT * FROM tbl_useraccount WHERE id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function updateInfor($user){

        }

        private function checkEmail($email){
            $email = mysqli_real_escape_string($this->db::$link, $email);  //Not change

            $query = "SELECT * FROM tbl_useraccount WHERE email  = '$email'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        private function checkPhone($phone){
            $phone = mysqli_real_escape_string($this->db::$link, $phone);  //Not change

            $query = "SELECT * FROM tbl_useraccount WHERE phone  = '$phone'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }
    }
?>