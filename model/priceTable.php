<?php

    class PriceTable{

        private $id;
        private $costPrice;
        private $unitCost;
        private $variableCost;
        private $fixedCost;
        private $totalCost;
        private $finalPrice;
        private $markup;
        private $profitMargin;
        private $profit;
        private $priceLabel;

        public function setId($id){
            $this->id = $id;
        }

        public function getId(){
            return $this->id;
        }

        public function setCostPrice($costPrice){
            $this->costPrice = str_replace(',', '.', $costPrice);
        }

        public function getCostPrice(){
            return $this->costPrice;
        }

        public function setUnitCost($unitCost){
            $this->unitCost = str_replace(',', '.', $unitCost);
        }

        public function getUnitCost(){
            return $this->unitCost;
        }

        public function setVariableCost($variableCost){
            $this->variableCost = str_replace(',', '.', $variableCost);
        }

        public function getVariableCost(){
            return $this->variableCost;
        }

        public function setFixedCost($fixedCost){
            $this->fixedCost = str_replace(',', '.', $fixedCost);
        }

        public function getFixedCost(){
            return $this->fixedCost;
        }

        public function setTotalCost($totalCost){
            $this->totalCost = str_replace(',', '.', $totalCost);
        }

        public function getTotalCost(){
            return $this->totalCost;
        }

        public function setFinalPrice($finalPrice){
            $this->finalPrice = str_replace(',', '.', $finalPrice);
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

        public function setProfitMargin($profitMargin){
            $this->profitMargin = $profitMargin;
        }

        public function getProfitMargin(){
            return $this->profitMargin;
        }

        public function setProfit($profit){
            $this->profit = str_replace(',', '.', $profit);
        }

        public function getProfit(){
            return $this->profit;
        }

        public function setPriceLabel($priceLabel){
            $this->priceLabel = $priceLabel;
        }

        public function getPriceLabel(){
            return $this->priceLabel;
        }
    }
?>