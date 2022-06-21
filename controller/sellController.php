<?php

    include_once('../repositorys/registerRepository.php');
    include_once('../model/register.php');

    class SellController{

        private $register;
        private $post;
        private $registerRepository;

        public function init(){
            $this->register = new Register();
            $this->registerRepository = new RegisterRepository();
        }

        public function __construct($post){

            $this->init();

            if(!$post) return;
            $this->post = $post;
        }
        
        public function findCurrentOpen(){
            
            $result = $this->registerRepository->findCurrentOpen('open');
            $stocks = $this->getResultValues($result);

            if(count($stocks) > 0){
                
                $stock = $stocks[0];
                return $stock->gettId(); 
            }

            $this->registerRepository->create(); 
        }

        public function createOpen(){

            $stock = new Product();
            return $this->registerRepository->createOpen();
        }

        public function getResultValues($result){

            $stocks = array();

            while ($data = $result->fetch_assoc()){ 
                $stock = new Product();
                $stock->setId($data['id']);
                $stock->setStatus($data['status']);
                $stock->setOpenDate($data['totalPayments']);
                $stock->setCloseDate($data['openDate']);
                $stock->setTotalPayments($data['closeDate']); 

                array_push($stocks, $stock);
            }

            return $stocks;
        }
    }
?>