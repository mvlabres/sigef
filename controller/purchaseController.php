<?php

    include_once('../repositorys/purchaseRepository.php');
    include_once('registerController.php');
    include_once('../model/purchase.php');
    include_once('../model/purchaseProduct.php');
    include_once('../repositorys/productRepository.php');
    include_once('stockController.php');
    include_once('../model/registerResume.php');

    class PurchaseController{

        private $purchase;
        private $registerResume;
        private $purchaseProduct;
        private $post;
        private $purchaseRepository;
        private $productRepository;
        private $stockController;
        private $registerController;

        public function init(){
            $this->purchase = new Purchase();
            $this->registerResume = new RegisterResume();
            $this->purchaseProduct = new PurchaseProduct();
            $this->purchaseRepository = new PurchaseRepository();
            $this->productRepository = new ProductRepository();
            $this->stockController = new StockController(null);
            $this->registerController = new RegisterController(null);
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
            $productCodes = $this->post['productCodes'];

            foreach ($productids as $key => $productid) {
                
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

                if($result){
                    
                    if(!$this->stockController->writeOffProduct($productCodes[$key])){
                        echo '<script>alert("Erro ao baixar o produto id '.$productid.' no estoque")</script>';
                        throw new Exception();
                    }
                    
                } else {
                    echo '<script>alert("Erro ao incluir o produto id '.$productid.' no pedido")</script>';
                    throw new Exception();
                    
                }
            }

            return true;
        }

        public function setPostFields(){
            $this->purchase = new Purchase();
            $this->purchase->setCustomerId($this->post['customerId']);
            $this->purchase->setTotalValue($this->post['totalValue']);
            $this->purchase->setDiscount($this->post['discount']);
            $this->purchase->setFinalValue($this->post['finalValue']);
            $this->purchase->setHasInvoice($this->post['withInvoice']);
            $this->purchase->setRegisterId($this->post['registerId']);
            $this->purchase->setInstallmentNumber($this->post['installmentNumber']);
            $this->purchase->setPaymentType($this->post['paymentType']);
        }

        public function findPurchaseResumeByRegisterId($registerId){

            $result = $this->purchaseRepository->findByRegisterId($registerId);

            $purchases = $this->setPurchaseFields($result);

            $purchaseQuantity = count($purchases);
            $purchaseCreditTotalValue = 0;
            $purchaseDebitTotalValue = 0;
            $purchasePixTotalValue = 0;
            $purchaseCashTotalValue = 0;
            $registerInitialValue = 0;
            $totalValue = 0;

            foreach ($purchases as $purchase) {

                switch ($purchase->getPaymentType()) {

                    case "credito":{
                        $purchaseCreditTotalValue +=  $purchase->getFinalValue();
                        break;
                    }

                    case "debito":{
                        $purchaseDebitTotalValue += $purchase->getFinalValue();
                        break;
                    }

                    case "dinheiro":{
                        $purchaseCashTotalValue +=  $purchase->getFinalValue();
                        break;
                    }

                    case "pix":{
                        $purchasePixTotalValue +=  $purchase->getFinalValue();
                        break;
                    }
                }

                $totalValue += $purchase->getFinalValue();
                
            }

            $register = $this->findRegisterById($registerId);

            $this->registerResume->setPurchaseQuantity(count($purchases));

            $this->registerResume->setRegisterInitialValue($register->getInitialValue());
            $this->registerResume->setTotalValue($totalValue);

            $this->registerResume->setPurchaseCreditTotalValue($purchaseCreditTotalValue);
            $this->registerResume->setPurchaseDebitTotalValue($purchaseDebitTotalValue);
            $this->registerResume->setPurchasePixTotalValue($purchasePixTotalValue);
            $this->registerResume->setPurchaseCashTotalValue($purchaseCashTotalValue);

            return $this->registerResume;
        }

        public function findRegisterById($registerId){
            return $this->registerController->findById($registerId);
        }

        public function setPurchaseFields($result){

            if(!$result) return null;

            $purchases = array();

            while ($data = $result->fetch_assoc()){ 

                $this->purchase = new Purchase();
                $this->purchase->setId($data['id']);
                $this->purchase->setPaymentType($data['paymentType']);
                $this->purchase->setCustomerId($data['customerId']);
                $this->purchase->setDiscount($data['discount']);
                $this->purchase->setFinalValue($data['finalValue']);
                $this->purchase->setHasInvoice($data['hasInvoice']);
                $this->purchase->setRegisterId($data['registerId']);
                $this->purchase->setInstallmentNumber($data['installmentNumber']);

                array_push($purchases, $this->purchase);
            }

            return $purchases;
        }
    }
?>