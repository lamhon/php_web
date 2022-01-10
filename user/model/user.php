<?php
    include_once '../../db/dbconnect.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require_once '../model/PHPMailer/src/Exception.php';
    require_once '../model/PHPMailer/src/PHPMailer.php';
    require_once '../model/PHPMailer/src/SMTP.php';

    require_once '../model/cart.php';

    include_once '../../lib/session.php';
?>

<?php
    class User{
        private $id;
        private $username;
        private $pwd;
        private $firstname;
        private $lastname;
        private $sex;
        private $birthday;
        private $email;
        private $phone;
        private $address;
        private $reg_date;
        private $stt;

        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        //Getter
        public function get_id(){
            return $this->id;
        }

        public function get_username(){
            return $this->username;
        }
        
        public function get_pwd(){
            return $this->pwd;
        }

        public function get_firstname(){
            return $this->firstname;
        }

        public function get_lastname(){
            return $this->lastname;
        }

        public function get_sex(){
            return $this->sex;
        }

        public function get_birthday(){
            return $this->birthday;
        }

        public function get_email(){
            return $this->email;
        }

        public function get_phone(){
            return $this->phone;
        }

        public function get_address(){
            return $this->address;
        }

        public function get_reg_date(){
            return $this->reg_date;
        }

        public function get_stt(){
            return $this->stt;
        }

        //Setter
        public function set_id($id){
            $this->id = $id;
        }

        public function set_username($username){
            $this->username = $username;
        }

        public function set_pwd($pwd){
            $this->pwd = $pwd;
        }

        public function set_firstname($firstname){
            $this->firstname = $firstname;
        }

        public function set_lastname($lastname){
            $this->lastname = $lastname;
        }

        public function set_sex($sex){
            $this->sex = $sex;
        }

        public function set_birthday($birthday){
            $this->birthday = $birthday;
        }

        public function set_email($email){
            $this->email = $email;
        }

        public function set_phone($phone){
            $this->phone = $phone;
        }

        public function set_address($address){
            $this->address = $address;
        }

        public function set_reg_date($reg_date){
            $this->reg_date = $reg_date;
        }

        public function set_stt($stt){
            $this->stt = $stt;
        }

        //------Control------//
        public function getUser($id){
            $query = "SELECT * FROM tbl_useraccount WHERE id = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

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
                $username = $user->get_username();
                $pwd = $user->get_pwd();
                $firstname = $user->get_firstname();
                $lastname = $user->get_lastname();
                $email = $user->get_email();
                    
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
                $id = $user->get_id();
                $firstname = $user->get_firstname();
                $lastname = $user->get_lastname();
                $sex = $user->get_sex();
                $birthday = $user->get_birthday();
                $email = $user->get_email();
                $phone = $user->get_phone();
                $address = $user->get_address();

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
            $query = "SELECT * FROM tbl_useraccount WHERE email  = '$email'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }

        }
        
        private function checkPhone($phone){
            $query = "SELECT * FROM tbl_useraccount WHERE phone  = '$phone'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        private function checkUser($username){
            $query = "SELECT * FROM tbl_useraccount WHERE username  = '$username'";
            $result = $this->db->select($query);
            if($result){
                return true;
            }else{
                return false;
            }
        }

        public function insertMessage($userid, $username, $email, $mess){
            $query = "INSERT INTO tbl_message(userid, username, email, mess, stt) VALUES ('$userid', '$username', '$email', '$mess', 0)";
            $result = $this->db->insert($query);
            if($result){
                $alert = '<div class="alert alert-success">Send message successfully</div>';
                return $alert;
            }else{
                $alert = '<div class="alert alert-danger">Send message failure</div>';
                return $alert;
            }
        }

        public function loginUser($username, $password){
            Session::checkUserLogin();
            $cartMo = new Cart();

            $query = "SELECT * FROM tbl_useraccount WHERE username = '$username' AND pwd = '$password'";
            $result = $this->db->select($query);

            if($result != false){

                $value = $result->fetch_assoc();
                if($value['stt'] == 1){
                    Session::set('userlogin', true);
                    Session::set('userId', $value['id']);
                    Session::set('username', $value['username']);

                    if(Session::get('cart-item') != null){
                        $cartlst = $cartMo->getCart($value['id']);
                        $cartSession = Session::get('cart-item');
                        if($cartlst){
                            while($result = $cartlst->fetch_assoc()){
                                foreach($cartSession as $productSession){
                                    if($productSession->get_idProduct() != $result['idproduct']){
                                        $cartMo->set_idUser($value['id']);
                                        $cartMo->set_idProduct($productSession->get_idProduct());
                                        $cartMo->set_quantity($productSession->get_quantity());
                                        
                                        $cartMo->insertItem($cart);
                                        unset($cartSession[$productSession->get_idProduct()]);
                                    }
                                }
                            }
                            Session::set('cart-item', null);
                        }
                    }

                    header('Location:index.php');
                    // $alert = '<div class="alert alert-success">Your account is active</div>';
                    // return $alert;
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