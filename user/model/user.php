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

        public function __construct($username, $pwd, $firstname, $lastname, $email){
            $this->username = $username;
            $this->pwd = $pwd;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
        }

        public function __destruct(){
            $this->username = null;
            $this->pwd = null;
            $this->firstname = null;
            $this->lastname = null;
            $this->email = null;
            $this->reg_date = null;
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
    }
?>