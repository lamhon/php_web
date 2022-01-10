<?php
    include_once '../model/category.php';
?>

<?php
    class CategoryController{
        private $cateMo;

        //initialize
        public function __construct(){
            $this->cateMo = new Category();
        }

        public function Switch($action){
            switch ($action){
                case "add_cate":
                    $cateName = $_POST['cateName'];
                    $insertCate = $this->cateMo->insert_category($cateName);
                    return $insertCate;
                    break;
                case "update_cate":
                    $id = $_GET['cateid'];
                    $cateName = $_POST['cateName'];
                    $cateStt = $_POST['cateStt'];

                    $updateCate = $this->cateMo->update_category($id, $cateName, $cateStt);
                    return $updateCate;
                    break;
            }
        }

        public function getAll_category(){
            $allCate = $this->cateMo->getAll_category();
            return $allCate;
        }

        public function getAll_categoryByStt($stt){
            $getCate = $this->cateMo->getAll_categoryByStt($stt);
            return $getCate;
        }

        public function getCategory($id){
            $getCate = $this->cateMo->getCategory($id);
            return $getCate;
        }
    }
?>