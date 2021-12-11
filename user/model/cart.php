<?php
    class Cart{
        private $idUser;
        private $idProduct;
        private $quantity;

        public function __construct($idUser, $idProduct, $quantity){
            $this->idUser = $idUser;
            $this->idProduct = $idProduct;
            $this->quantity = $quantity;
        }

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
        public function set_idUser($id){
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