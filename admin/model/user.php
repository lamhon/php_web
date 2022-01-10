<?php
    include_once '../../db/dbconnect.php';
    include_once '../../lib/session.php';
?>

<?php
    class User{
        private $id;
        private $username;
        private $roleid;
        private $email;
        private $fullname;
        private $phone;
        private $reg_date;
        private $stt;

        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        //SET method
        public function setUsername($username){
            $this->username = $username;
        }
        public function setRoleId($roleid){
            $this->roleid = $roleid;
        }
        public function setEmail($email){
            $this->email = $email;
        }
        public function setFullname($fullname){
            $this->fullname = $fullname;
        }
        public function setPhone($phone){
            $this->phone = $phone;
        }
        public function setStt($stt){
            $this->stt = $stt;
        }

        //GET method
        public function getId(){
            return $this->id;
        }
        public function getUsername(){
            return $this->username;
        }
        public function getRoleId(){
            return $this->roleid;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getFullname(){
            return $this->fullname;
        }
        public function getPhone(){
            return $this->phone;
        }
        public function getRegDate(){
            return $this->reg_date;
        }
        public function getStt(){
            return $this->stt;
        }

        // ------------ Control ------------ //
        public function login($username, $userpass){
            Session::checkLogin();
            if(empty($username) || empty($userpass)){
                $alert = "User and password must be not empty";
                return $alert;
            }else{
                $query = "SELECT * FROM tbl_admin WHERE username = '$username' AND pwd = '$userpass'";
                $result = $this->db->select($query);

                if($result != false){
                    $value = $result->fetch_assoc();
                    Session::set('adminlogin', true);
                    Session::set('adminId', $value['id']);
                    Session::set('adminUser', $value['username']);
                    Session::set('adminName', $value['fullname']);
                    Session::set('adminRole', $value['roleid']);

                    header('Location:index.php');
                }else{
                    $alert = "User or password is wrong";
                    return $alert;
                }
            }
        }
    }
?>