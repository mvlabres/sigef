<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    include_once('../repositorys/productRepository.php');
    include_once('priceTableController.php');
    include_once('productFamilyController.php');
    include_once('../model/product.php');

    class ProductController{

        private $product;
        private $post;
        private $productRepository;
        private $priceTableController;
        private $productFamilyController;

        private $RELATIONSHIP = [
            'priceTable' => [],
            'productFamily' => []
        ];

        public function init(){
            $this->product = new Product();
            $this->productRepository = new ProductRepository();
            $this->priceTableController = new PriceTableController(null);
            $this->productFamilyController = new ProductFamilyController(null);
        }

        public function __construct($post){

            $this->init();

            if(!$post) return;
            $this->post = $post;
        }

        public function newInstance(){
            return new Product();
        }

        public function findRelationship(){

            $this->RELATIONSHIP['priceTable'] = $this->priceTableController->findAll();
            $this->RELATIONSHIP['productFamily'] = $this->productFamilyController->findAll();

            return $this->RELATIONSHIP;
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
    }
?>