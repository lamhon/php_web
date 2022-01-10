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

        //Get
        public function getId(){
            return $this->id;
        }

        public function getProductname(){
            return $this->productname;
        }

        public function getPrice(){
            return $this->price;
        }

        public function getSale(){
            return $this->sale;
        }

        public function getCategory(){
            return $this->categoryid;
        }

        public function getInfo(){
            return $this->info;
        }

        public function getDescript(){
            return $this->descript;
        }

        public function getQuantity(){
            return $this->quantity;
        }

        public function getImg(){
            return $this->img;
        }

        public function getStt(){
            return $this->stt;
        }

        //Set
        public function setproductId($id){
            $this->id = $id;
        }

        public function setProductname($productname){
            $this->productname = $productname;
        }

        public function setPrice($price){
            $this->price = $price;
        }

        public function setSale($sale){
            $this->sale = $sale;
        }

        public function setCategory($categoryid){
            $this->categoryid = $categoryid;
        }

        public function setInfo($info){
            $this->info = $info;
        }

        public function setDescript($descript){
            $this->descript = $descript;
        }

        public function setQuantity($quantity){
            $this->quantity = $quantity;
        }

        public function setImg($img){
            $this->img = $img;
        }

        public function setStt($stt){
            $this->stt = $stt;
        }

        // ------------- Control -------------//
        public function insert_product($data, $files){
            $productName = $data['productName'];
            $productPrice = $data['productPrice'];
            $productSale = $data['productSale'];
            $productCategory = $data['productCategory'];
            $productInformation = $data['productInformation'];
            $productDescription = $data['productDescription'];
            $productQuantity = $data['productQuantity'];
            
            if($this->checkExist($productName)){
                $alert = '<div class="alert alert-danger">Product name already exist</div>';
                return $alert;
            }else{
                if($productSale == ''){
                    $productSale = 0;
                }
                $permited = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10). '.'.$file_ext;
                $uploaded_image = "../../public/".$unique_image;

                if($productPrice == 0){
                    $alert = '<div class="alert alert-danger">Price cannot be 0</div>';
                    return $alert;
                }else if($file_name == ''){
                    $alert = '<div class="alert alert-danger">Please insert image</div>';
                    return $alert;
                }else{
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "INSERT INTO tbl_product(productname, price, sale, categoryid, info, descript, quantity, img, stt) VALUES ('$productName', '$productPrice', '$productSale', '$productCategory', '$productInformation', '$productDescription', '$productQuantity', '$unique_image', 1)";
                    $result = $this->db->insert($query);
                    if($result){
                        $alert = '<div class="alert alert-success">Insert new product successfully</div>';
                        return $alert;
                    }else{
                        $alert = '<div class="alert alert-danger">Insert new product failure</div>';
                        return $alert;
                    }
                }
            }
        }

        public function getAll_product(){
            $query = "SELECT * FROM tbl_product ORDER BY productname DESC";
            $result = $this->db->select($query);
            return $result;
        }

        public function getProduct($id){
            $query = "SELECT * FROM tbl_product WHERE id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getQuantityProduct($id){
            $query = "SELECT * FROM tbl_product WHERE id = '$id'";
            $result = $this->db->select($query);
            if($result){
                $product = $result->fetch_assoc();
                return $product['quantity'];
            }
            return false;
        }

        public function updateQuantity($id, $quantity){
            $query = "UPDATE tbl_product SET quantity = '$quantity' WHERE id = '$id'";
            $result = $this->db->update($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        public function checkExist($productName){
            $query = "SELECT * FROM tbl_product WHERE productname = '$productName'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }
        
        public function update_product($product, $files){
            $oldProductName = $this->getProduct($product->getId())->fetch_assoc()['productname'];

            //If exist name and this name is not oldname
            if(($this->checkExist($product->getProductname()) && $oldProductName == $product->getProductname()) || (!$this->checkExist($product->getProductname()))){
                $id = $product->getId();
                $productname = $product->getProductname();
                $price = floatval($this->currencyFormat($product->getPrice()));
                $sale = $product->getSale();
                $categoryid = $product->getCategory();
                $info = $product->getInfo();
                $descript = $product->getDescript();
                $quantity = $product->getQuantity();
                $stt = $product->getStt();

                //img file
                $permited = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10). '.'.$file_ext;
                $uploaded_image = "../../public/".$unique_image;

                if($file_name ==''){
                    $query = "UPDATE tbl_product SET productname = '$productname', price = '$price', sale = '$sale', categoryid = '$categoryid', info = '$info', descript = '$descript', quantity = '$quantity', stt = '$stt' WHERE id = '$id'";
                    $result = $this->db->update($query);
                    if($result){
                        $alert = '<div class="alert alert-success">Update product successfully</div>';
                        return $alert;
                    }else{
                        $alert = '<div class="alert alert-danger">Update product failure</div>';
                        return $alert;
                    }
                }else if($price == 0){
                    $alert = '<div class="alert alert-danger">Price cannot be 0</div>';
                    return $alert;
                }else{
                    move_uploaded_file($file_temp, $uploaded_image);
                
                    $query = "UPDATE tbl_product SET productname = '$productname', price = '$price', sale = '$sale', categoryid = '$categoryid', info = '$info', descript = '$descript', quantity = '$quantity', img = '$unique_image', stt = '$stt' WHERE id = '$id'";
                    $result = $this->db->update($query);
                    if($result){
                        $alert = '<div class="alert alert-success">Update product successfully</div>';
                        return $alert;
                    }else{
                        $alert = '<div class="alert alert-danger">Update product failure</div>';
                        return $alert;
                    }
                }
            }else{
                $alert = '<div class="alert alert-danger">Product name already exist</div>';
                return $alert;
            }
        }

        public function currencyFormat($price){
            $result = str_replace(array(','), '', $price);
            return $result;
        }
    }
?>