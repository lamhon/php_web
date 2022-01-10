<?php
    include_once '../model/user.php';
?>


<?php
    class UserController{
        private $userMo;

        //initialize
        public function __construct(){
            $this->userMo = new User();
        }
    
        public function Switch($action){
            switch($action){
                case "login":
                    $username = $_POST['userName'];
                    $password = md5($_POST['password']);
                    return $this->userMo->loginUser($username, $password);
                    break;
                case "send_message":
                    $getUser = $this->userMo->getUser(Session::get('userId'));

                    if($getUser){
                        $resUser = $getUser->fetch_assoc();
        
                        $firstname = $resUser['firstname'];
                        $lastname = $resUser['lastname'];
                        $name = $firstname . ' ' . $lastname;

                        $insertMess = $this->userMo->insertMessage(Session::get('userId'), $name, $resUser['email'], $_POST['message']);
                        return $insertMess;
                    }else{
                        header("Location:login.php");
                    }
                    break;
                case "register":
                    if(strcmp(md5($_POST['password']), md5($_POST['pass'])) != 0){
                        $alert = '<div class="alert alert-danger">Confirm password wrong!</div>';
                        return $alert;
                    }else{
                        $this->userMo->set_username($_POST['userName']);
                        $this->userMo->set_pwd(md5($_POST['password']));
                        $this->userMo->set_firstname($_POST['firstName']);
                        $this->userMo->set_lastname($_POST['lastName']);
                        $this->userMo->set_email($_POST['email']);
                        $insertUser = $this->userMo->insert_user($this->userMo);
                        return $insertUser;
                    }
                    break;
                case "update_profile":
                    $this->userMo->set_firstname($_POST['userFirstname']);
                    $this->userMo->set_lastname($_POST['userLastname']);
                    $this->userMo->set_sex($_POST['userSex']);

                    $birthday = strtotime($_POST['userBirthdayMonth'].'/'.$_POST['userBirthdayDay'].'/'.$_POST['userBirthdayYear']);
                    $formatdate = date('Y-m-d', $birthday);
                    $this->userMo->set_birthday($formatdate);

                    $this->userMo->set_email($_POST['userEmail']);
                    $this->userMo->set_phone($_POST['userPhone']);
                    $this->userMo->set_address($_POST['userAddress']);
                    $this->userMo->set_id(Session::get('userId'));

                    return $updateInfo = $this->userMo->updateInfor($this->userMo);
                    break;
                case "forgot_password":
                    $username = $_POST['userName'];
                    $email = $_POST['email'];

                    $check = $this->userMo->checkChangePass($username, $email);
                    if($check != false){
                        $profile = $check->fetch_assoc();
                        $name = $profile['firstname'].' '.$profile['lastname'];

                        $send = $this->userMo->sendSecretNumber($email, $name);
                        if($send){
                            Session::set('user', $username);
                            header('Location:change-password.php');
                        }
                    }else{
                        $alert = '<div class="alert alert-danger">Wrong information</div>';
                    }
                    break;
                case "change_password":
                    $secretNumber = md5($_POST['secretNumber']);
                    $pwd = $_POST['password'];
                    $confirm = $_POST['pass'];
                    if($confirm != $pwd){
                        $alert = '<div class="alert alert-danger">Confirm password is wrong!</div>';
                    }else{
                        $checkSecret = $this->userMo->checkSecretNumber(Session::get('user'), $secretNumber);
                        if($checkSecret){
                            $changePass = $this->userMo->changePass(Session::get('user'), md5($pwd));
                            if($changePass){
                                $alert = '<div class="alert alert-success">Change password success!</div>';
                                Session::set('user', null);
                            }
                        }else{
                            $alert = '<div class="alert alert-danger">Your secret number is wrongq!</div>';
                        }
                    }
                    return $alert;
                    break;
            }
        }

        public function getUser($id){
            $user = $this->userMo->getUser($id);
            return $user;
        }
    }
?>