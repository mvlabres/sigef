<?php

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


        public function create(){

            $this->setFields();
            $this->productRepository->setProduct($this->product);
            return $this->productRepository->create();
        }

        public function getLastCreated(){
            $result = $this->productRepository->findLastCreated();
            $products = $this->getResultValues($result);
            return $products[0]; 
        }

        public function getResultValues($result){

            $products = array();

            while ($data = $result->fetch_assoc()){ 
                $product = new Product();
                $product->setId($data['id']);
                $product->setDescription($data['description']);
                $product->setPriceTableId($data['priceId']);
                $product->setBarcode();
                $product->setSize($data['size']);
                $product->setProductFamilyId($data['productFamilyId']);
                $product->setPriceTableId($data['priceId']); 

                array_push($products, $product);

                return $products;
            }

        }

        public function setFields(){

            $this->product->setId($this->post['productId']);
            $this->product->setDescription($this->post['description']);
            $this->product->setPriceTableId($this->post['priceTable']);
            $this->product->setSize($this->post['size']);
            $this->product->setProductFamilyId($this->post['productFamily']);
            $this->product->setBarcode();

        }

       

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