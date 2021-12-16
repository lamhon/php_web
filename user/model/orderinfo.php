<?php
    class OrderInfo{
        private $id;
        private $orderid;
        private $productid;
        private $quantity;
        private $price;
        private $feedback;

        public function __construct($orderid, $productid, $quantity, $price){
            $this->orderid = $orderid;
            $this->productid = $productid;
            $this->quantity = $quantity;
            $this->price = $price;
        }

        //get method
        public function get_id(){
            return $this->this->id;
        }

        public function get_orderid(){
            return $this->orderid;
        }

        public function get_productid(){
            return $this->productid;
        }

        public function get_quantity(){
            return $this->quantity;
        }

        public function get_price(){
            return $this->price;
        }

        public function get_feedback(){
            return $this->feedback;
        }

        //set method
        public function set_orderid($orderid){
            $this->orderid = $orderid;
        }

        public function set_productid($productid){
            $this->productid = $productid;
        }

        public function set_quantity($quantity){
            $this->quantity = $quantity;
        }

        public function set_price($price){
            $this->price = $price;
        }

        public function set_feedback($feedback){
            $this->feedback = $feedback;
        }
    }
?>