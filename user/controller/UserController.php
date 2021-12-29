<?php
    include_once '../../db/dbconnect.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require_once '../controller/PHPMailer/src/Exception.php';
    require_once '../controller/PHPMailer/src/PHPMailer.php';
    require_once '../controller/PHPMailer/src/SMTP.php';
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

        public function checkChangePass($username, $email){
            $query = "SELECT * FROM tbl_useraccount WHERE username = '$username' AND email = '$email'";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }

        public function checkSecretNumber($username, $secretNumber){
            $query = "SELECT * FROM tbl_useraccount WHERE username = '$username' AND secretnumber = '$secretNumber'";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }

        public function changePass($username, $password){
            $query = "UPDATE tbl_useraccount SET pwd = '$password', secretnumber = null WHERE username = '$username'";
            $updateQuery = $this->db->update($query);
            if($updateQuery){
                return true;
            }else{
                return true;
            }
        }

        public function sendSecretNumber($email, $name){
            $secretNumber = rand(100000,999999);

            $mail = new PHPMailer(true);
            try {
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                // $mail->Host = 'smtp.gmail.com';
                $mail->Host = "smtp.gmail.com"; 
                $mail->SMTPAuth = true;
                $mail->Username = 'hoangtunglamltd@gmail.com';
                $mail->Password = 'ohgeeeaktvgylmyy';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('hoangtunglamltd@gmail.com', 'Sor Web');
                $mail->addAddress($email, $name);
                $mail->isHTML(true);
                $mail->Subject = 'Change your password';
                $content = '<p>'.'Your secret number is: '.$secretNumber.'</p>';
                $mail->Body = $content;

                // $mail->SMTPOptions = [
                //     'ssl' => [
                //         'verify_peer' => false,
                //         'verify_peer_name' => false,
                //         'allow_self_signed' => true,
                //     ]
                // ];

                if($mail->send()){
                    $hashSecret = md5($secretNumber);
                    $query = "UPDATE tbl_useraccount SET secretnumber = '$hashSecret' WHERE email = '$email'";
                    $updateQuery = $this->db->update($query);
                    if($updateQuery){
                        return true;
                    }else{
                        return true;
                    }
                }else{
                    return false;
                }
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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