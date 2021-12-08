<?php
    include_once '../../lib/session.php';
    Session::checkUserLogin();
    include_once '../../db/dbconnect.php'; 
?>

<?php
    class LoginController{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function loginUser($username, $password){
            $username = mysqli_real_escape_string($this->db::$link, $username);
            $password = mysqli_real_escape_string($this->db::$link, $password);

            $query = "SELECT * FROM tbl_useraccount WHERE username = '$username' AND pwd = '$password'";
            $result = $this->db->select($query);

            if($result != false){

                $value = $result->fetch_assoc();
                if($value['stt'] == 1){
                    Session::set('userlogin', true);
                    Session::set('userId', $value['id']);
                    Session::set('username', $value['username']);

                    header('Location:index.php');
                    //$alert = '<div class="alert alert-success">Your account is active</div>';
                    //return $alert;
                }else{
                    $alert = '<div class="alert alert-danger">Your account is locked</div>';
                    return $alert;
                }
            }else{
                $alert = '<div class="alert alert-danger">Username or password is wrong!</div>';
                return $alert;
            }
        }
    }
?>