<?php

class PurchaseProduct{

        private $id;
        private $productId;
        private $purchaseId;
        private $product;
        private $markup;
        private $costPrice;
        private $unitCost;
        private $variableCost;
        private $fixedCost;
        private $finalPrice;

        public function setId($id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function setProductId($productId){
            $this->productId = $productId;
        }

        public function getProductId(){
            return $this->productId;
        }

        public function setPurchaseId($purchaseId){
            $this->purchaseId = $purchaseId;
        }

        public function getPurchaseId(){
            return $this->purchaseId;
        }

        public function setProduct($product){
            $this->product = $product;
        }

        public function getProduct(){
            return $this->product;
        }

        public function setCostPrice($costPrice){
            $this->costPrice = floatval($costPrice);
        }

        public function getCostPrice(){
            return $this->costPrice;
        }

        public function setUnitCost($unitCost){
            $this->unitCost = floatval($unitCost);
        }

        public function getUnitCost(){
            return $this->unitCost;
        }

        public function setVariableCost($variableCost){
            $this->variableCost = floatval($variableCost);
        }

        public function getVariableCost(){
            return $this->variableCost;
        }

        public function setFixedCost($fixedCost){
            $this->fixedCost = floatval($fixedCost);
        }

        public function getFixedCost(){
            return $this->fixedCost;
        }

        public function setFinalPrice($finalPrice){
            $this->finalPrice = floatval($finalPrice);
        }

        public function getFinalPrice(){
            return $this->finalPrice;
        }

        public function setMarkup($markup){
            $this->markup = $markup;
        }

        public function getMarkup(){
            return $this->markup;
        }
}
?>