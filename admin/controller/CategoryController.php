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


        // Add new Category function
        public function insert_category($categoryName){
            if($this->checkExist($categoryName)){
                $alert = '<div class="alert alert-danger">Category name already exist</div>';
                return $alert;
            }else{
                $categoryName = mysqli_real_escape_string($this->db::$link, $categoryName);

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

        // Get all category from db
        public function getAll_category(){
            $query = "SELECT * FROM tbl_category ORDER BY categoryname DESC";
            $result = $this->db->select($query);
            return $result;
        }

        // Get all category from db by stt
        public function getAll_categoryByStt($stt){
            $query = "SELECT * FROM tbl_category WHERE stt = '$stt' ORDER BY categoryname DESC";
            $result = $this->db->select($query);
            return $result;
        }


        // Get category by id
        public function getCategory($id){
            $query = "SELECT * FROM tbl_category WHERE id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        //Update value category
        public function update_category($cateId, $categoryName, $cateStt){
            $oldCateName = $this->getCategory($cateId)->fetch_assoc()['categoryname'];

            $cateId = mysqli_real_escape_string($this->db::$link, $cateId);
            $categoryName = mysqli_real_escape_string($this->db::$link, $categoryName);
            $cateStt = mysqli_real_escape_string($this->db::$link, $cateStt);

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
            $categoryName = mysqli_real_escape_string($this->db::$link, $categoryName);  //Not change

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