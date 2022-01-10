<?php
    include_once '../model/product.php';
    include_once '../model/cart.php';
?>

<?php
    class ProductController{
        private $productMo;

        public function __construct(){
            $this->productMo = new Product();
        }
        
        public function getProduct($item){
            $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:$item;
            $current_page = !empty($_GET['page'])?$_GET['page']:1;
            $offset = ($current_page - 1) * $item_per_page;

            $product = $this->productMo->get_Product_Paging($item_per_page, $offset, 1);

            $totalRecord = $this->productMo->get_AllProduct(1);
            $totalRecord = $totalRecord->num_rows;
            $totalPage = ceil($totalRecord / $item_per_page);
    
            $data["get_product_paging"] = $this->productMo->get_Product_Paging($item_per_page, $offset, 1);
            $data["totalRecord"] = $totalRecord;
            $data["totalPage"] = $totalPage;

            return $data;
        }

        public function getRate($idProduct){
            $rate = $this->productMo->getRate($idProduct);
            return $rate;
        }

        public function getCategory($cateId){
            $cate = $this->productMo->getCategoryObject($cateId);
            return $cate;
        }

        public function getAllCategory(){
            $cate = $this->productMo->getAll_category();
            return $cate;
        }

        public function ShopView(){
            $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:9;
            $current_page = !empty($_GET['page'])?$_GET['page']:1;
            $offset = ($current_page - 1) * $item_per_page;
            
            if(isset($_GET['cate'])){
                $prolst = $this->productMo->get_Product_Cate_Paging($item_per_page, $offset, $_GET['cate'], 1);
                $totalRecords = $this->productMo->get_AllProduct_ByCate($_GET['cate'], 1);
            }else if(isset($_GET['minPrice']) && isset($_GET['maxPrice'])){
                $minPrice = floatval($_GET['minPrice']);
                $maxPrice = floatval($_GET['maxPrice']);
                if($minPrice > $maxPrice){
                    $minPrice = $minPrice + $maxPrice;
                    $maxPrice = $minPrice - $maxPrice;
                    $minPrice = $minPrice - $maxPrice;
                }

                $prolst = $this->productMo->get_Product_Price_Paging($item_per_page, $offset, $minPrice, $maxPrice, 1);
                $totalRecords = $this->productMo->get_AllProduct_ByPrice($minPrice, $maxPrice, 1);
            }else{
                $prolst = $this->productMo->get_Product_Paging($item_per_page, $offset, 1);
                $totalRecords = $this->productMo->get_AllProduct(1);
            }

            $data["totalRecords"] = $totalRecords;
            $data["item_per_page"] = $item_per_page;
            $data["product_list"] = $prolst;
            return $data;
        }
        
        public function getProductById($id){
            $product = $this->productMo->getProductById($id);
            return $product;
        }

        public function getReviewQuantity($productId){
            $review = $this->productMo->getReviewQuantity($productId);
            return $review;
        }

        public function getQuanOfStar($idProduct, $star){
            $quan = $this->productMo->getQuanOfStar($idProduct, $star);
            return $quan;
        }

        public function getReview($productId){
            $review = $this->productMo->getReview($productId);
            return $review;
        }

        public function getPercentReview($productId, $star){
            $percent = $this->productMo->getPercentReview($productId, $star);
            return $percent;
        }

        public function checkIdBill($billid, $userid){
            $check = $this->productMo->checkIdBill($billid, $userid);
            return $check;
        }
    }