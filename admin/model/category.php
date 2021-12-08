<?php 
    class Category{
        private $categoryId;
        private $categoryName;
        private $categoryStt;

        // Set method
        public function setName($categoryName){
            $this->categoryName = $categoryName;
        }

        public function setStt($categoryStt){
            $this->categoryStt = $categoryStt;
        }

        // Get method
        public function getId(){
            return $this->categoryId;
        }

        public function getName(){
            return $this->categoryName;
        }

        public function getStt(){
            return $this->categoryStt;
        }
    }
?>