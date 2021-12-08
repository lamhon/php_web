<?php
    class Product{
        private $id;
        private $productname;
        private $price;
        private $sale;
        private $categoryid;
        private $info;
        private $descript;
        private $quantity;
        private $img;
        private $stt;


        public function __construct($productname, $price, $sale, $categoryid, $info, $descript, $quantity, $stt){
            $this->productname = $productname;
            $this->price = $price;
            $this->sale = $sale;
            $this->categoryid = $categoryid;
            $this->info = $info;
            $this->descript = $descript;
            $this->quantity = $quantity;
            $this->stt = $stt;
        }

        public function __destruct(){
            $this->id = null;
            $this->productname = null;
            $this->price = null;
            $this->sale = null;
            $this->categoryid = null;
            $this->info = null;
            $this->descript = null;
            $this->quantity = null;
            $this->img = null;
            $this->stt = null;
        }

        //Get
        public function getId(){
            return $this->id;
        }

        public function getProductname(){
            return $this->productname;
        }

        public function getPrice(){
            return $this->price;
        }

        public function getSale(){
            return $this->sale;
        }

        public function getCategory(){
            return $this->categoryid;
        }

        public function getInfo(){
            return $this->info;
        }

        public function getDescript(){
            return $this->descript;
        }

        public function getQuantity(){
            return $this->quantity;
        }

        public function getImg(){
            return $this->img;
        }

        public function getStt(){
            return $this->stt;
        }

        //Set
        public function setproductId($id){
            $this->id = $id;
        }

        public function setProductname($productname){
            $this->productname = $productname;
        }

        public function setPrice($price){
            $this->price = $price;
        }

        public function setSale($sale){
            $this->sale = $sale;
        }

        public function setCategory($categoryid){
            $this->categoryid = $categoryid;
        }

        public function setInfo($info){
            $this->info = $info;
        }

        public function setDescript($descript){
            $this->descript = $descript;
        }

        public function setQuantity($quantity){
            $this->quantity = $quantity;
        }

        public function setImg($img){
            $this->img = $img;
        }

        public function setStt($stt){
            $this->stt = $stt;
        }
    }
?>