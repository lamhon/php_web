<?php
    include '../../lib/session.php';
    Session::checkLogin();
    include_once '../../db/dbconnect.php';
    include '../../helpers/format.php';
?>

<?php
    class LoginController{
        private $db;
        //private $fm;

        public function __construct(){
            $this->db = new Database();
            //$this->fm = new Format();
        }
        
        public function login_admin($adminUser, $adminPass){
            // $username = $this->fm->validation($username);
            // $userpass = $this->fm->validation($userpass);

            $username = mysqli_real_escape_string($this->db::$link, $adminUser);
            $userpass = mysqli_real_escape_string($this->db::$link, $adminPass);

            if(empty($username) || empty($userpass)){
                $alert = "User and password must be not empty";
                return $alert;
            }else{
                $query = "SELECT * FROM tbl_admin WHERE  username = '$username' AND pwd = '$userpass'";
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

        public function logout_admin(){
            
        }
    }
?>