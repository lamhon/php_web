<?php
    class Message{
        private $id;
        private $userid;
        private $username;
        private $email;
        private $message;
        private $stt;

        public function __construct($userid, $username, $email, $message, $stt){
            $this->userid = $userid;
            $this->username = $username;
            $this->email = $email;
            $this->message = $message;
            $this->stt = $stt;
        }
        
        //Get method
        public function get_id(){
            return $this->id;
        }

        public function get_userid(){
            return $this->userid;
        }

        public function get_username(){
            return $this->username;
        }

        public function get_email(){
            return $this->email;
        }

        public function get_message(){
            return $this->message;
        }

        public function get_stt(){
            return $this->stt;
        }

        //Set method
        public function set_id($id){
            $this->id = $id;
        }

        public function set_userid($userid){
            $this->userid = $userid;
        }

        public function set_username($username){
            $this->username = $username;
        }

        public function set_email($email){
            $this->email = $email;
        }

        public function set_message($message){
            $this->message = $message;
        }

        public function set_stt($stt){
            $this->stt = $stt;
        }
    }
?>