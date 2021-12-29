<?php
    class Cart{
        private $idUser;
        private $idProduct;
        private $quantity;

        public function __construct($idUser, $idProduct, $quantity){
            $this->set_idUser($idUser);
            $this->set_idProduct($idProduct);
            $this->set_quantity($quantity);
        }

        // public function __destruct(){
        //     $this->idUser = null;
        //     $this->idProduct = null;
        //     $this->quantity = null;
        // }

        // Getter
        public function get_idUser(){
            return $this->idUser;
        }

        public function get_idProduct(){
            return $this->idProduct;
        }

        public function get_quantity(){
            return $this->quantity;
        }

        //Setter
        public function set_idUser($idUser){
            $this->idUser = $idUser;
        }

        public function set_idProduct($idProduct){
            $this->idProduct = $idProduct;
        }

        public function set_quantity($quantity){
            $this->quantity = $quantity;
        }
    }
?>