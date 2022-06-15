<?php

    require_once('../model/product.php');
    require_once('../repositorys/productRepository.php');

    class PrintBarcodeController{

        private $product;
        private $productRepository;

        public function init(){
            $this->product = new Product();
            $this->productRepository = new ProductRepository();
        }

        public function __construct(){

            $this->init();
        }

        public function findById($productId){

            $product = new Product();
            $result = $this->productRepository->findById($productId);

            while ($data = $result->fetch_assoc()){ 
                $product = new Product();
                $product->setfinalPrice($data['final_Price']);
                $product->setDescription($data['description']);
                $product->setSize($data['size']);
            }

            return $product;
        }
    }
?>