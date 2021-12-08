<?php
    class Session{
        public static function init(){
            if(version_compare(phpversion(), '5.4.0', '<')){
                if(session_id() == ''){
                    session_start();
                }
            }else{
                if(session_status() == PHP_SESSION_NONE){
                    session_start();
                }
            }
        }

        public static function set($key, $value){
            $_SESSION[$key] = $value;
        }

        public static function get($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            }else{
                return false;
            }
        }

        public static function checkSession(){
            self::init();
            if(self::get("adminlogin") == false){
                self::destroy();
                header("Location:login.php");
            }
        }

        public static function checkUserSession(){
            self::init();
            // if(self::get("userlogin") == false){
            //     self::userDestroy();
            //     header("Location:index.php");
            // }
        }

        public static function checkLogin(){
            self::init();
            if(self::get("adminlogin") == true){
                header("Location:index.php");
            }
        }

        public static function checkUserLogin(){
            self::init();
            if(self::get("userlogin") == true){
                //header("Location:index.php");
            }
        }

        public static function destroy(){
            session_destroy();
            header("Location:login.php");
        }

        public static function userDestroy(){
            session_destroy();
            header("Location:index.php");
        }
    }
?>
