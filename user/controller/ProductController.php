<?php
    include_once '../../db/dbconnect.php';
?>

<?php
    class ProductController{
        private $db;

        //initialize
        public function __construct(){
            $this->db = new Database();
        }

        public function get_Product_Paging($item_per_page, $offset, $stt){
            $query = "SELECT * FROM tbl_product WHERE stt = $stt ORDER BY id DESC LIMIT $item_per_page OFFSET $offset";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_Product_Cate_Paging($item_per_page, $offset, $cateid, $stt){
            $query = "SELECT * FROM tbl_product WHERE stt = $stt AND categoryid = $cateid ORDER BY id DESC LIMIT $item_per_page OFFSET $offset";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_Product_Price_Paging($item_per_page, $offset, $minPrice, $maxPrice, $stt){
            $query = "SELECT * FROM tbl_product WHERE stt = $stt AND (price >= $minPrice AND price <= $maxPrice) ORDER BY id DESC LIMIT $item_per_page OFFSET $offset";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_AllProduct($stt){
            $query = "SELECT * FROM tbl_product WHERE stt = '$stt'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_AllProduct_ByCate($categoryid, $stt){
            $query = "SELECT * FROM tbl_product WHERE stt = '$stt' AND categoryid = '$categoryid'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_AllProduct_ByPrice($minPrice, $maxPrice, $stt){
            $query = "SELECT * FROM tbl_product WHERE stt = '$stt' AND (price >= '$minPrice' AND price <= '$maxPrice')";
            $result = $this->db->select($query);
            return $result;
        }

        public function getProductById($id){
            $query = "SELECT * FROM tbl_product WHERE id = '$id' AND stt = 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function currencyFormat($price){
            $result = str_replace(array(','), '', $price);
            return $result;
        }
    }
?>