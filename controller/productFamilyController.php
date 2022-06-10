<?php
    require_once('../repositorys/productFamilyRepository.php');
    require_once('../model/productFamily.php');

    class ProductFamilyController{

        private $post;
        private $productFamily;
        private $productFamilyRepository;

        public function init(){
            $this->productFamily = new ProductFamily();
            $this->productFamilyRepository = new ProductFamilyRepository();
        }

        public function __construct($post){

            $this->init();

            if(!$post) return;
            $this->post = $post;
        }


        public function create(){
            if(!isset($this->post['description']) && $this->post['description'] == null) return null;

            $productFamily = new ProductFamily();
            $productFamily->setDescription($this->post['description']);

            $this->productFamilyRepository->setProductFamily($productFamily);
            return $this->productFamilyRepository->create();
        }

        public function findAll(){

            $productFamily = new ProductFamily();
            $productsFamily = array();

            $result = $this->productFamilyRepository->findAll();

            while ($data = $result->fetch_assoc()){ 
                $productFamily = new ProductFamily();
                $productFamily->setId($data['id']);
                $productFamily->setDescription($data['description']);
                
                array_push($productsFamily, $productFamily);
            }

            return $productsFamily;
        }
    }
?>