<?php
    include_once '../../db/dbconnect.php';
?>

<?php
    class MessageController{
        private $db;

        //initialize
        public function __construct(){
            $this->db = new Database();
        }

        public function insertMessage($message){
            $userid = $message->get_userid();
            $username = $message->get_username();
            $email = $message->get_email();
            $mess = $message->get_message();

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
    }
?>