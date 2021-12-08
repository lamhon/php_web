<?php
    include_once '../../db/config.php';
?>

<?php 
    class Database{
        private $host = DB_HOST;
        private $dbname = DB_NAME;
        private $username = DB_USER;
        private $password = DB_PASS;

        public static $link;
        public $error;

        function __construct(){
            $this->connectDB();
        }

        private function connectDB(){
            // try{
            //     $conn = new PDO("mysql:host = $this->host; dbname = $this->dbname", $this->username, $this->password);
            //     echo "Connect DB success";
            //     return true;
            // }catch (PDOException $pe){
            //     die("Could not connect to DB: ".$pe->getMessage());
            //     return false;
            // }

            if(!isset(self::$link)){
                self::$link = new mysqli($this->host, $this->username, $this->password, $this->dbname);
                //$this->link = new PDO("mysql:host = $this->host; dbname = $this->dbname", $this->username, $this->password);
                if(!self::$link){
                    $this->error= "Connection fail".self::$link->connect_error;
                    return false;
                }
            }

            
            // else{
            //     mysqli_set_charset($this->link, 'utf8');
            // }
        }

        public function select($query){
            $result = self::$link->query($query) or die(self::$link->error.__LINE__);
            if($result->num_rows > 0){
                return $result;
            }else{
                return false;
            }
        }

        public function insert($query){
            $insert_row = self::$link->query($query) or die(self::$link->error.__LINE__);
            if($insert_row){
                return $insert_row;
            }else{
                return false;
            }
        }

        public function update($query){
            $update_row = self::$link->query($query) or die(self::$link->error.__LINE__);
            if($update_row){
                return $update_row;
            }else{
                return false;
            }
        }

        public function delete($query){
            $delete_row = self::$link->query($query) or die(self::$link->error.__LINE__);
            if($delete_row){
                return $delete_row;
            }else{
                return false;
            }
        }
    }
?>