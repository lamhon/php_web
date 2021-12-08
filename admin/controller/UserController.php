<?php
    include_once '../../db/dbconnect.php';
?>

<?php 
    class UserController{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        // Get all users from db
        public function getAll_user(){
            $query = "SELECT * FROM tbl_useraccount ORDER BY username DESC";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>