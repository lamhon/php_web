<?php
    include_once '../model/user.php';
?>

<?php 
    class UserController{
        private $userMo;

        public function __construct(){
            $this->userMo = new User();
        }

        public function login(){
            $login = $this->userMo->login($_POST['adminUser'], md5($_POST['adminPass']));
            return $login;
        }
    }
?>