<?php

    require_once('../model/priceTable.php');
    require_once('../repositorys/priceTableRepository.php');

    class PriceTableController{

        private $priceTable;
        private $post;
        private $priceTableRepository;

        public function init(){
            $this->priceTable = new PriceTable();
            $this->priceTableRepository = new PriceTableRepository();
        }

        public function __construct($post){

            $this->init();

            if(!$post) return;
            $this->post = $post;
        }

        public function newInstance(){
            return new PriceTable();
        }

        public function create(){

            $this->setFields();
            $this->priceTableRepository->setPriceTable($this->priceTable);
            return $this->priceTableRepository->create();
        }

        public function findAll(){

            $priceTable = new PriceTable();
            $priceTables = array();

            $result = $this->priceTableRepository->findAll();

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

                $this->buildPricesLabel($priceTable);

                array_push($priceTables, $priceTable);
            }

            return $priceTables;
        }

        public function setFields(){

            $this->priceTable->setId($this->post['id']);
            $this->priceTable->setCostPrice($this->post['costPrice']);
            $this->priceTable->setUnitCost($this->post['unitCost']);
            $this->priceTable->setVariableCost($this->post['variableCost']);
            $this->priceTable->setFixedCost($this->post['fixedCost']);
            $this->priceTable->setMarkup($this->post['markup']);
            $this->priceTable->setTotalCost($this->post['totalCost']);
            $this->priceTable->setFinalPrice($this->post['finalPrice']);
            $this->priceTable->setProfitMargin($this->post['profitMargin']);

        }

        public function calculate(){

            $this->setFields();

            $totalCost = $this->priceTable->getUnitCost() + $this->priceTable->getVariableCost() + $this->priceTable->getFixedCost() + $this->priceTable->getCostPrice();

            $this->priceTable->setTotalCost( $totalCost );

            $this->priceTable->setFinalPrice( $this->priceTable->getCostPrice() * ( $this->priceTable->getMarkup() / 100 ));

            $this->priceTable->setProfitMargin( floatval(($this->priceTable->getTotalCost() / $this->priceTable->getFinalPrice()) * 100));

            $this->priceTable->setProfit( floatval($this->priceTable->getFinalPrice() - $this->priceTable->getTotalCost()));

            $this->priceTable->setProfitMargin( round(($this->priceTable->getProfit() / $this->priceTable->getFinalPrice()) *100, 2) );

            return $this->priceTable;
        }

        public function buildPricesLabel($priceTable){

            $priceLabel = '';

            $priceLabel .= 'Preço de custo: R$ ' . $priceTable->getCostPrice();
            $priceLabel .= ' - Custo fixo: R$ ' . $priceTable->getFixedCost();
            $priceLabel .= ' - Custo var.: R$ ' . $priceTable->getVariableCost();
            $priceLabel .= ' - Custo unt.: R$ ' . $priceTable->getUnitCost();
            $priceLabel .= ' - Markup: R$ ' . $priceTable->getMarkup();
            $priceLabel .= ' - Preço final: R$ ' . $priceTable->getFinalPrice();

            $priceTable->setPriceLabel($priceLabel);
        }
    }
?>