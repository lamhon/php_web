<?php
    include_once '../model/message.php';
?>

<?php
    class MessageController{
        private $messMo;

        //initialize
        public function __construct(){
            $this->messMo = new Message();
        }

        public function getAllMessage(){
            $mess = $this->messMo->getAllMessage();
            return $mess;
        }

        public function getMessById($id){
            $mess = $this->messMo->getMessById($id);
            return $mess;
        }

        public function updateSttMess($id, $stt){
            $update = $this->messMo->updateSttMess($id, $stt);
            return $update;
        }

        public function sendMessage(){
            $getMess = $this->getMessById($_GET['messid']);
            if($getMess){
                $mess = $getMess->fetch_assoc();

                $sendMess = $this->messMo->sendMessage($_GET['messid'], $mess['email'], $_POST['subject'], $_POST['reply'], $mess['username']);
                return $sendMess;
            }
            // return $_POST['subject'];
        }
    }
?>