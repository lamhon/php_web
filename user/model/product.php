<?php
    include_once '../../db/dbconnect.php';
?>

<?php
    class Product{
        private $id;
        private $productname;
        private $price;
        private $sale;
        private $categoryid;
        private $info;
        private $descript;
        private $quantity;
        private $img;
        private $stt;

        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        //Get method
        public function getId() {
            return $this->id;
        }

        public function getProductname() {
            return $this->productname;
        }

        public function getPrice() {
            return $this->price;
        }

        public function getSale() {
            return $this->sale;
        }

        public function getCategory() {
            return $this->categoryid;
        }

        public function getInfo() {
            return $this->info;
        }

        public function getDescript() {
            return $this->descript;
        }

        public function getQuantity() {
            return $this->quantity;
        }

        public function getImg() {
            return $this->img;
        }

        public function getStt() {
            return $this->stt;
        }
        
        //------Control------//
        public function get_Product_Paging($item_per_page, $offset, $stt){
            $query = "SELECT * FROM tbl_product WHERE stt = $stt AND quantity > 0 ORDER BY id DESC LIMIT $item_per_page OFFSET $offset";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_Product_Cate_Paging($item_per_page, $offset, $cateid, $stt){
            $query = "SELECT * FROM tbl_product WHERE (stt = $stt AND categoryid = $cateid) AND quantity > 0 ORDER BY id DESC LIMIT $item_per_page OFFSET $offset";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_Product_Price_Paging($item_per_page, $offset, $minPrice, $maxPrice, $stt){
            $query = "SELECT * FROM tbl_product WHERE (stt = $stt AND quantity > 0) AND (price >= $minPrice AND price <= $maxPrice) ORDER BY id DESC LIMIT $item_per_page OFFSET $offset";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_AllProduct($stt){
            $query = "SELECT * FROM tbl_product WHERE stt = '$stt' AND quantity > 0";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_AllProduct_ByCate($categoryid, $stt){
            $query = "SELECT * FROM tbl_product WHERE (stt = '$stt' AND categoryid = '$categoryid') AND quantity > 0";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_AllProduct_ByPrice($minPrice, $maxPrice, $stt){
            $query = "SELECT * FROM tbl_product WHERE (stt = '$stt' AND quantity > 0) AND (price >= '$minPrice' AND price <= '$maxPrice')";
            $result = $this->db->select($query);
            return $result;
        }

        public function getProductById($id){
            $query = "SELECT * FROM tbl_product WHERE id = '$id' AND stt = 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function checkIdBill($billid, $userid){
            $query = "SELECT * FROM tbl_orderbill WHERE (id = '$billid' AND userid = '$userid') AND deliverydate IS NOT NULL";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        public function insertFeedback($infoid, $userid, $productid, $rate, $mess, $files, $fileimg){
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES[$fileimg]['name'];
            $file_size = $_FILES[$fileimg]['size'];
            $file_temp = $_FILES[$fileimg]['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10). '.'.$file_ext;
            $uploaded_image = "../../public/feedback/".$unique_image;

            if($rate == NULL){
                $alert = '<div class="alert alert-danger">Please rate this product</div>';
                return $alert;
            }else if($mess == ''){
                $alert = '<div class="alert alert-danger">Please feedback this product</div>';
                return $alert;
            }else if($file_name == ''){
                $alert = '<div class="alert alert-danger">Please insert photo of this product</div>';
                return $alert;
            }else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_feedback(userid, productid, rate, mess, img) VALUES ('$userid', '$productid', '$rate', '$mess', '$unique_image')";
                $update = "UPDATE tbl_orderinfo SET feedback = 1 WHERE id = '$infoid'";
                $result = $this->db->insert($query);
                $update = $this->db->update($update);
                if($result){
                    if($update){
                        $alert = '<div class="alert alert-success">Feedback successfully</div>';
                        return $alert;
                    }else{
                        $alert = '<div class="alert alert-danger">Something wrong</div>';
                        return $alert;
                    }
                }else{
                    $alert = '<div class="alert alert-danger">Feedback failure</div>';
                    return $alert;
                }
            }
        }

        public function checkFeedback($billId){
            $query = "SELECT * FROM tbl_orderinfo WHERE orderid = $billId";
            $result = $this->db->select($query);
            
            $countProduct = 0;
            $feedback = 0;

            if($result){
                while($info = $result->fetch_assoc()){
                    $countProduct++;
                    if($info['feedback'] == 1){
                        $feedback++;
                    }
                }
    
                if($feedback < $countProduct){
                    return true;
                }else{
                    return false;
                }
            }
            
        }

        public function currencyFormat($price){
            $result = str_replace(array(','), '', $price);
            return $result;
        }

        public function getRate($idproduct){
            $query = "SELECT * FROM tbl_feedback WHERE productid = '$idproduct'";
            $result = $this->db->select($query);

            $i = 0;
            $totalrate = 0;
            $rating = 0;
            if($result){
                while($rating = $result->fetch_assoc()){
                    $i++;
                    $totalrate += $rating['rate'];
                }
                $rating = $totalrate/$i;
            }
            return $rating;
        }

        public function getReviewQuantity($idproduct){
            $query = "SELECT * FROM tbl_feedback WHERE productid = '$idproduct'";
            $result = $this->db->select($query);

            $i = 0;
            if($result){
                while($rating = $result->fetch_assoc()){
                    $i++;
                }
            }
            return $i;
        }

        public function getPercentReview($idproduct, $star){
            $query = "SELECT * FROM tbl_feedback WHERE productid = '$idproduct' AND rate = '$star'";
            $result = $this->db->select($query);
            $quan = 0;
            if($result){
                while($rating = $result->fetch_assoc()){
                    $quan++;
                }
            }

            $total = $this->getReviewQuantity($idproduct);
            return ($quan / $total)*100;
        }

        public function getQuanOfStar($idproduct, $star){
            $query = "SELECT * FROM tbl_feedback WHERE productid = '$idproduct' AND rate = '$star'";
            $result = $this->db->select($query);
            $quan = 0;
            if($result){
                while($rating = $result->fetch_assoc()){
                    $quan++;
                }
            }
            return $quan;
        }

        public function getReview($idproduct){
            $query = "SELECT * FROM tbl_feedback WHERE productid = '$idproduct'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getCategoryObject($id){
            $query = "SELECT * FROM tbl_category WHERE id = '$id' AND stt = 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function getAll_category(){
            $query = "SELECT * FROM tbl_category WHERE stt = 1 ORDER BY categoryname DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function updateQuantity($productId, $quantity){
            $query = "UPDATE tbl_product SET quantity = '$quantity' WHERE id = '$productId'";
            $update = $this->db->update($query);
            return $update;
        }
    }
?>