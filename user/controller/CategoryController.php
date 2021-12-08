<?php
    include_once '../../db/dbconnect.php';
?>

<?php
    class CategoryController{
        private $db;

        //initialize
        public function __construct(){
            $this->db = new Database();
        }

        // Get all category from db
        public function getAll_category(){
            $query = "SELECT * FROM tbl_category WHERE stt = 1 ORDER BY categoryname DESC";
            $result = $this->db->select($query);
            return $result;
        }


        // Get category by id
        public function getCategory($id){
            $query = "SELECT * FROM tbl_category WHERE id = '$id' AND stt = 1";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>