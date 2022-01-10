<?php
    include_once '../../db/dbconnect.php';
?>

<?php 
    class Category{
        private $categoryId;
        private $categoryName;
        private $categoryStt;

        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        // Set method
        public function setName($categoryName){
            $this->categoryName = $categoryName;
        }

        public function setStt($categoryStt){
            $this->categoryStt = $categoryStt;
        }

        // Get method
        public function getId(){
            return $this->categoryId;
        }

        public function getName(){
            return $this->categoryName;
        }

        public function getStt(){
            return $this->categoryStt;
        }

        //---------------- Control ------------------//
        public function insert_category($categoryName){
            if($this->checkExist($categoryName)){
                $alert = '<div class="alert alert-danger">Category name already exist</div>';
                return $alert;
            }else{
                if(empty($categoryName)){
                    $alert = '<div class="alert alert-danger">Category name must be not empty</div>';
                    return $alert;
                }else{
                    $query = "INSERT INTO tbl_category(categoryname, stt) VALUES ('$categoryName', 1)";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = '<div class="alert alert-success">Insert new category successfully</div>';
                        return $alert;
                    }else{
                        $alert = '<div class="alert alert-danger">Insert new category failure</div>';
                        return $alert;
                    }
                }
            }
        }

        public function getAll_category(){
            $query = "SELECT * FROM tbl_category ORDER BY categoryname DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function getAll_categoryByStt($stt){
            $query = "SELECT * FROM tbl_category WHERE stt = '$stt' ORDER BY categoryname DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function getCategory($id){
            $query = "SELECT * FROM tbl_category WHERE id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_category($cateId, $categoryName, $cateStt){
            $oldCateName = $this->getCategory($cateId)->fetch_assoc()['categoryname'];

            if(empty($categoryName)){
                $alert = '<div class="alert alert-danger">Category name must be not empty</div>';
                return $alert;
            }else{
                if($this->checkExist($categoryName) && $categoryName != $oldCateName){
                    $alert = '<div class="alert alert-danger">Category name already exist</div>';
                    return $alert;
                }else{
                    $query = "UPDATE tbl_category SET categoryname = '$categoryName', stt = '$cateStt' WHERE id = '$cateId'";
                    $result = $this->db->update($query);
                    if($result){
                        $alert = '<div class="alert alert-success">Update category successfully</div>';
                        return $alert;
                    }else{
                        $alert = '<div class="alert alert-danger">Update category failure</div>';
                        return $alert;
                    }
                }
            }
        }

        private function checkExist($categoryName){
            $query = "SELECT * FROM tbl_category WHERE categoryname = '$categoryName'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }
    }
?>