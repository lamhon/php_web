<?php
    include_once '../model/product.php';
?>

<?php
    class ProductController{
        private $productMo;

        //initialize
        public function __construct(){
            $this->productMo = new Product();
        }

        // Add new Product function
        public function Switch($action){
            switch ($action){
                case "add_product":
                    $data['productName'] = $_POST['productName'];
                    $data['productPrice'] = $_POST['productPrice'];
                    $data['productSale'] = $_POST['productSale'];
                    $data['productCategory'] = $_POST['productCategory'];
                    $data['productInformation'] = $_POST['productInformation'];
                    $data['productDescription'] = $_POST['productDescription'];
                    $data['productQuantity'] = $_POST['productQuantity'];

                    $insert = $this->productMo->insert_product($data, $_FILES);
                    return $insert;
                    break;
                case "update_product":
                    $this->productMo->setproductId($_GET['productid']);
                    $this->productMo->setProductname($_POST['productName']);
                    $this->productMo->setPrice($_POST['productPrice']);
                    $this->productMo->setSale($_POST['productSale']);
                    $this->productMo->setCategory($_POST['productCategory']);
                    $this->productMo->setInfo($_POST['productInfo']);
                    $this->productMo->setDescript($_POST['productDescript']);
                    $this->productMo->setQuantity($_POST['productQuantity']);
                    $this->productMo->setStt($_POST['productStt']);

                    $update = $this->productMo->update_product($this->productMo, $_FILES);
                    return $update;

                    break;
            }
        }

        // Get all product from db
        public function getAll_product(){
            $getProduct = $this->productMo->getAll_product();
            return $getProduct;
        }

        // Get product by id
        public function getProduct($id){
            $getProduct = $this->productMo->getProduct($id);
            return $getProduct;
        }

        public function getQuantity($id){
            $getQuan = $this->productMo->getQuantity($id);
            return $getQuan;
        }

        public function updateQuantity($id, $quantity){
            $updateQuan = $this->productMo->updateQuantity($id, $quantity);
            return $updateQuan;
        }
    }
?>