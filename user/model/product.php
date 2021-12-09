<?php
    class Product{
        private $id;
        private $quantity;
        private $price;

        public function __construct($id, $quantity, $price){
            $this->id = $id;
            $this->quantity = $quantity;
            $this->price = $price;
        }

        // Getter
        public function get_id(){
            return $this->id;
        }

        public function get_quantity(){
            return $this->quantity;
        }

        public function get_price(){
            return $this->price;
        }

        //Setter
        public function set_id($id){
            $this->id = $id;
        }

        public function set_quantity($quantity){
            $this->quantity = $quantity;
        }

        public function set_price($price){
            $this->price = $price;
        }
    }
?>