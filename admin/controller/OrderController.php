<?php
    include_once '../model/order.php';
?>

<?php
    class OrderController{
        private $orderMo;

        //initialize
        public function __construct(){
            $this->orderMo = new Order();
        }

        public function getlstOrder($deliverystt){
            $getlst = $this->orderMo->getlstOrder($deliverystt);
            return $getlst;
        }

        public function changeDeliveryStt($id, $stt){
            $change = $this->orderMo->changeDeliveryStt($id, $stt);
            return $change;
        }

        public function updateDeliveryDate($id){
            $update = $this->orderMo->updateDeliveryDate($id);
            return $update;
        }

        public function checkOrderid($id){
            $check = $this->orderMo->checkOrderid($id);
            return $check;
        }

        public function getOrderInfo($orderid){
            $getOrderInfo = $this->orderMo->getOrderInfo($orderid);
            return $getOrderInfo;
        }
    }
?>