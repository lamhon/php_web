<?php
    include_once '../../db/dbconnect.php';
?>


<?php
    class UserController{
        private $db;

        //initialize
        public function __construct(){
            $this->db = new Database();
        }
        public function getUser($id){
            $query = "SELECT * FROM tbl_useraccount WHERE id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        //Insert user
        public function insert_user($user){
            if($this->checkEmail($user->get_email())){
                $alert = '<div class="alert alert-danger">Email already exist</div>';
                return $alert;
            }else if($this->checkPhone($user->get_phone())){
                $alert = '<div class="alert alert-danger">Phone already exist</div>';
                return $alert;
            }else if($this->checkUser($user->get_username())){
                $alert = '<div class="alert alert-danger">Username already exist</div>';
                return $alert;
            }else{
                $username = mysqli_real_escape_string($this->db::$link, $user->get_username());
                $pwd = mysqli_real_escape_string($this->db::$link, $user->get_pwd());
                $firstname = mysqli_real_escape_string($this->db::$link, $user->get_firstname());
                $lastname = mysqli_real_escape_string($this->db::$link, $user->get_lastname());
                $email = mysqli_real_escape_string($this->db::$link, $user->get_email());
                    
                $query = "INSERT INTO tbl_useraccount(username, pwd, firstname, lastname, email, stt) VALUES ('$username', '$pwd', '$firstname', '$lastname', '$email', 1)";
                $result = $this->db->insert($query);
                if($result){
                    $alert = '<div class="alert alert-success">Register successfully</div>';
                    return $alert;
                }else{
                    $alert = '<div class="alert alert-danger">Register failure</div>';
                    return $alert;
                }
            }
        }

        public function updateInfor($user){
            $oldEmail = $this->getUser($user->get_id())->fetch_assoc();
            $oldEmail = $oldEmail['email'];
            $oldPhone = $this->getUser($user->get_id())->fetch_assoc();
            $oldPhone = $oldPhone['phone'];
            if($this->checkEmail($user->get_email()) && $user->get_email() != $oldEmail){
                $alert = '<div class="alert alert-danger">Email already exist</div>';
                return $alert;
            }else if($this->checkPhone($user->get_phone()) && $user->get_phone() != $oldPhone){
                $alert = '<div class="alert alert-danger">Phone already exist</div>';
                return $alert;
            }else{
                $id = mysqli_real_escape_string($this->db::$link, $user->get_id());
                $firstname = mysqli_real_escape_string($this->db::$link, $user->get_firstname());
                $lastname = mysqli_real_escape_string($this->db::$link, $user->get_lastname());
                $sex = mysqli_real_escape_string($this->db::$link, $user->get_sex());
                $birthday = mysqli_real_escape_string($this->db::$link, $user->get_birthday());
                $email = mysqli_real_escape_string($this->db::$link, $user->get_email());
                $phone = mysqli_real_escape_string($this->db::$link, $user->get_phone());
                $address = mysqli_real_escape_string($this->db::$link, $user->get_address());

                $query = "UPDATE tbl_useraccount SET firstname = '$firstname', lastname = '$lastname', sex = '$sex', birthday = '$birthday', email = '$email', phone = '$phone', uaddress = '$address' WHERE id = '$id'";
            
                $result = $this->db->update($query);
                if($result){
                    $alert = '<div class="alert alert-success">Update information successfully</div>';
                    return $alert;
                }else{
                    $alert = '<div class="alert alert-danger">Update information failure</div>';
                    return $alert;
                }
            }
        }

        private function checkEmail($email){
            $email = mysqli_real_escape_string($this->db::$link, $email);  //Not change

            $query = "SELECT * FROM tbl_useraccount WHERE email  = '$email'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        private function checkPhone($phone){
            $phone = mysqli_real_escape_string($this->db::$link, $phone);  //Not change

            $query = "SELECT * FROM tbl_useraccount WHERE phone  = '$phone'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        private function checkUser($username){
            $username = mysqli_real_escape_string($this->db::$link, $username);

            $query = "SELECT * FROM tbl_useraccount WHERE username  = '$username'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }
    }
?>