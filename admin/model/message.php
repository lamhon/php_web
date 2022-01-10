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
    class Message{
        private $id;
        private $userid;
        private $username;
        private $email;
        private $mess;
        private $stt;

        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        //Set method
        public function setUserid($userid){
            $this->userid = $userid;
        }
        public function setUsername($username){
            $this->username = $username;
        }
        public function setEmail($email){
            $this->email = $email;
        }
        public function setMess($mess){
            $this->mess = $mess;
        }
        public function setStt($stt){
            $this->stt = $stt;
        }

        //Get method
        public function getId(){
            return $this->id;
        }
        public function getUserid(){
            return $this->userid;
        }
        public function getUsername(){
            return $this->username;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getMess(){
            return $this->mess;
        }
        public function getStt(){
            return $this->stt;
        }

        public function getAllMessage(){
            $query = "SELECT * FROM tbl_message";
            $result = $this->db->select($query);
            return $result;
        }

        public function getMessById($id){
            $query = "SELECT * FROM tbl_message WHERE id = $id";
            $result = $this->db->select($query);
            return $result;
        }

        public function updateSttMess($id, $stt){
            $query = "UPDATE tbl_message SET stt = '$stt' WHERE id = '$id'";
            $update = $this->db->update($query);
            return $update;
        }

        public function sendMessage($messid, $email, $subject, $message, $name){
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
                $mail->Subject = $subject;
                $content = '<p>'.$message.'</p>';
                $mail->Body = $content;

                // $mail->SMTPOptions = [
                //     'ssl' => [
                //         'verify_peer' => false,
                //         'verify_peer_name' => false,
                //         'allow_self_signed' => true,
                //     ]
                // ];

                if($mail->send()){
                    $alert = '<div class="alert alert-success">Reply successfully</div>';
                    $this->updateSttMess($messid, 1);
                    return $alert;
                }else{
                    $alert = '<div class="alert alert-danger">Reply failure</div>';
                    return $alert;
                }
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            
        }
    }
?>