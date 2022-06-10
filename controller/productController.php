<?php

    require('../repositorys/productRepository.php');
    require('../repositorys/priceTableRepository.php');

    class ProductController{

        private $product;
        private $post;
        private $productRepository;
        private $priceTableRepository;

        public function init(){
            $this->product = new Product();
            $this->productRepository = new ProductRepository();
            $this->priceTableRepository = new PriceTableRepository();
        }

        public function __construct($post){

            $this->init();

            if(!$post) return;
            $this->post = $post;
        }

        public function newInstance(){
            return new Product();
        }

        public function findPriceTable(){
            $this->priceTableRepository->findAll();
        }


        // public function create(){

        //     $this->setFields();
        //     $this->priceTableRepository->setPriceTable($this->priceTable);
        //     return $this->priceTableRepository->create();
        // }

        // public function findAll(){

        //     $productFamily = new ProductFamily();
        //     $productsFamily = array();

        //     $result = $this->productFamilyRepository->findAll();

        //     while ($data = $result->fetch_assoc()){ 
        //         $productFamily = new ProductFamily();
        //         $productFamily->setId($data['id']);
        //         $productFamily->setDescription($data['description']);
                
        //         array_push($productsFamily, $productFamily);
        //     }

        //     return $productsFamily;
        // }

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
    }
?>