<?php

    include_once('../repositorys/purchaseRepository.php');
    include_once('../model/purchase.php');
    include_once('../model/purchaseProduct.php');
    include_once('../repositorys/productRepository.php');

    class PurchaseController{

        private $purchase;
        private $purchaseProduct;
        private $post;
        private $purchaseRepository;
        private $productRepository;

        public function init(){
            $this->purchase = new Purchase();
            $this->purchaseProduct = new PurchaseProduct();
            $this->purchaseRepository = new PurchaseRepository();
            $this->productRepository = new ProductRepository();
        }

        public function __construct($post){

            $this->init();

            if(!$post) return;
            $this->post = $post;
        }
        
        public function create(){

            try {

                $this->setPostFields();
                $this->purchaseRepository->setPurchase($this->purchase);
                $id =  $this->purchaseRepository->create();

                if(!$id) {
                    echo '<script>alert("Erro ao criar o pedido")</script>';
                    throw new Exception();
                }

                return $this->createProducts($id); 

               
            } catch (Exception $ex) {
                return false;
            }
        }

        public function createProducts($purchaseId){

            $productids = $this->post['products'];

            foreach ($productids as $productid) {
                
                $result = $this->productRepository->findById($productid);

                if(!$result) {
                    echo '<script>alert("Erro ao incluir o produto id '.$productid.' no pedido")</script>';
                    throw new Exception();
                }

                while ($data = $result->fetch_assoc()){ 
                    $this->purchaseProduct = new PurchaseProduct();
                    $this->purchaseProduct->setPurchaseId($purchaseId);
                    $this->purchaseProduct->setProductId($productid);
                    $this->purchaseProduct->setMarkup($data['price_markup']);
                    $this->purchaseProduct->setCostPrice($data['cost_price']);
                    $this->purchaseProduct->setUnitCost($data['unit_cost']);
                    $this->purchaseProduct->setVariableCost($data['variable_cost']);
                    $this->purchaseProduct->setFixedCost($data['fixed_cost']);
                    $this->purchaseProduct->setFinalPrice($data['final_Price']);
                }

                $this->purchaseRepository->setPurchaseProduct($this->purchaseProduct);
                $result = $this->purchaseRepository->createProduct();

                if(!$result){
                    echo '<script>alert("Erro ao incluir o produto id '.$productid.' no pedido")</script>';
                    throw new Exception();
                }
            }

            return true;
        }

        public function setPostFields(){
            $this->purchase->setCustomerId($this->post['customerId']);
            $this->purchase->setTotalValue($this->post['totalValue']);
            $this->purchase->setDiscount($this->post['discount']);
            $this->purchase->setFinalValue($this->post['finalValue']);
            $this->purchase->setHasInvoice($this->post['withInvoice']);
            $this->purchase->setRegisterId($this->post['registerId']);
            $this->purchase->setInstallmentNumber($this->post['installmentNumber']);
            $this->purchase->setPaymentType($this->post['paymentType']);
        }

        // public function getResultValues($result){

        //     $stocks = array();

        //     while ($data = $result->fetch_assoc()){ 
        //         $stock = new Product();
        //         $stock->setId($data['id']);
        //         $stock->setStatus($data['status']);
        //         $stock->setOpenDate($data['totalPayments']);
        //         $stock->setCloseDate($data['openDate']);
        //         $stock->setTotalPayments($data['closeDate']); 

        //         array_push($stocks, $stock);
        //     }

        //     return $stocks;
        // }
    }
?>