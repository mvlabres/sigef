<?php

    require_once('../model/priceTable.php');
    require_once('../repositorys/priceTableRepository.php');

    class PrintBarcodeController{

        private $priceTable;
        private $priceTableRepository;

        public function init(){
            $this->priceTable = new PriceTable();
            $this->priceTableRepository = new PriceTableRepository();
        }

        public function __construct(){

            $this->init();
        }

        public function findById($priceId){

            $priceTable = new PriceTable();
            $result = $this->priceTableRepository->findById($priceId);

            while ($data = $result->fetch_assoc()){ 
                $priceTable = new PriceTable();
                $priceTable->setId($data['id']);
                $priceTable->setCostPrice($data['costPrice']);
                $priceTable->setUnitCost($data['unitCost']);
                $priceTable->setVariableCost($data['variableCost']);
                $priceTable->setFixedCost($data['fixedCost']);
                $priceTable->setTotalCost($data['totalCost']);
                $priceTable->setFinalPrice($data['finalPrice']);
                $priceTable->setMarkup($data['markup']);
                $priceTable->setProfitMargin($data['profitMargin']);
            }

            return $priceTable;
        }
    }
?>