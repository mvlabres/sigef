<?php

    include_once('../model/stock.php');
    include_once('../repositorys/stockRepository.php');

    class StockController{

        private $stock;
        private $post;

        public function init(){
            $this->stock = new Stock();
            $this->stockRepository = new StockRepository();
        }

        public function __construct($post){

            $this->init();

            if(!$post) return;
            $this->post = $post;
        }

        public function create(){

            $this->stock->setProductId($this->post['productId']);
            $this->stock->setProductCode($this->post['productCode']);
            $this->stockRepository->setStock($this->stock);

            return $this->stockRepository->create();
        }

        public function findAll(){

            $stock = new Stock();
            $stocks = array();

            $result = $this->stockRepository->findAll();

            while ($data = $result->fetch_assoc()){ 
                $stock = new Stock();
                $stock->setId($data['id']);
                $stock->setEntryDate($data['entryDate']);
                $stock->setDepartureDate($data['departureDate']);
                $stock->setQuantity($data['quantity']);
                $stock->setProductId($data['productId']);
                $stock->setProductDescription($data['product']);
                
                array_push($stocks, $stock);
            }

            return $stocks;
        }

        public function writeOffProduct($productCode){
            return $this->stockRepository->writeOffProduct($productCode);
        }

    }
?>