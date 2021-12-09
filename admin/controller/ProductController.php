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

        // Add new Product function
        public function insert_product($data, $files){
            if($this->checkExist($data['productName'])){
                $alert = '<div class="alert alert-danger">Product name already exist</div>';
                return $alert;
            }else{
                $productName = mysqli_real_escape_string($this->db::$link, $data['productName']);
                $productPrice = floatval($this->currencyFormat(mysqli_real_escape_string($this->db::$link, $data['productPrice'])));
                $productSale = floatval(mysqli_real_escape_string($this->db::$link, $data['productSale']));
                $productCategory = mysqli_real_escape_string($this->db::$link, $data['productCategory']);
                $productInformation = mysqli_real_escape_string($this->db::$link, $data['productInformation']);
                $productDescription = mysqli_real_escape_string($this->db::$link, $data['productDescription']);
                $productQuantity = intval(mysqli_real_escape_string($this->db::$link, $data['productQuantity']));

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

                if($productName == '' || $productPrice == '' ||
                    $productCategory == '' || $productInformation == '' || $productDescription == '' || 
                    $productQuantity == '' || $file_name == ''){
                    $alert = '<div class="alert alert-danger">Field must be not empty</div>';
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

        // Get all product from db
        public function getAll_product(){
            $query = "SELECT * FROM tbl_product ORDER BY productname DESC";
            $result = $this->db->select($query);
            return $result;
        }


        // Get product by id
        public function getProduct($id){
            $query = "SELECT * FROM tbl_product WHERE id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        //Update value product
        public function update_product($product, $files){
            $oldProductName = $this->getProduct($product->getId())->fetch_assoc()['productname'];

            //If exist name and this name is not oldname
            if(($this->checkExist($product->getProductname()) && $oldProductName == $product->getProductname()) || (!$this->checkExist($product->getProductname()))){
                $id = mysqli_real_escape_string($this->db::$link, $product->getId());
                $productname = mysqli_real_escape_string($this->db::$link, $product->getProductname());
                $price = floatval($this->currencyFormat(mysqli_real_escape_string($this->db::$link, $product->getPrice())));
                $sale = mysqli_real_escape_string($this->db::$link, $product->getSale());
                $categoryid = mysqli_real_escape_string($this->db::$link, $product->getCategory());
                $info = mysqli_real_escape_string($this->db::$link, $product->getInfo());
                $descript = mysqli_real_escape_string($this->db::$link, $product->getDescript());
                $quantity = mysqli_real_escape_string($this->db::$link, $product->getQuantity());
                $stt = mysqli_real_escape_string($this->db::$link, $product->getStt());

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

        // Check name already exists in db
        public function checkExist($productName){
            $productName = mysqli_real_escape_string($this->db::$link, $productName);  //Not change

            $query = "SELECT * FROM tbl_product WHERE productname = '$productName'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        public function currencyFormat($price){
            $result = str_replace(array(','), '', $price);
            return $result;
        }
    }
?>