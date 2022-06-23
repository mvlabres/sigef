<?php
require_once('../controller/connection.php');

    class PurchaseRepository{

        private $purchaseProduct;
        private $mySqli;
        private $INIIAL_REGISTER_VALUE = 250.00;
    
        public function __construct(){
            $connect = new Connection();
            $this->mySqli = $connect->connect(); 
        }
    
        public function setPurchase($purchase){
            $this->purchase = $purchase;
        }

        public function setPurchaseProduct($purchaseProduct){
            $this->purchaseProduct = $purchaseProduct;
        }

        public function create(){

            try{
    
                if(!$this->purchase) return false;
    
                $sql = $this->setInsertQuery('FIELDS') . $this->setInsertQuery('VALUES');
                       
                $this->mySqli->query($sql);
                return $this->mySqli->insert_id;
    
            }catch(Exception $e){
                return false;
            }
        }

        public function createProduct(){

            try{
    
                if(!$this->purchaseProduct) return false;
    
                $sql = "INSERT INTO PurchaseProduct(productId, markup, variableCost, unitCost, fixedCost, costPrice, finalPrice, purchaseId) 
                        VALUES (".$this->purchaseProduct->getProductId().", ".$this->purchaseProduct->getMarkup().", ".$this->purchaseProduct->getVariableCost().", ".$this->purchaseProduct->getUnitCost().", ".$this->purchaseProduct->getFixedCost().", ".$this->purchaseProduct->getCostPrice().", ".$this->purchaseProduct->getFinalPrice().", ".$this->purchaseProduct->getPurchaseId().")";
                       
                $this->mySqli->query($sql);
                return true;
    
            }catch(Exception $e){
                return false;
            }
        }

        public function setInsertQuery($queryPart){

            switch ($queryPart) {
                case 'FIELDS':
                    return $this->setInsertQueryFields();
                    break;

                case 'VALUES':
                    return $this->setInsertQueryValues();
                    break;
            }
        }

        public function setInsertQueryFields(){

            $query = 'INSERT INTO Purchase(';
            $query .= ($this->purchase->getCustomerId() != null) ? 'customerId,' : '';
            $query .= ($this->purchase->getTotalValue() != null) ? 'totalValue,' : '';
            $query .= ($this->purchase->getDiscount() != null) ? 'discount,' : '';
            $query .= ($this->purchase->getFinalValue() != null) ? 'finalValue,' : '';
            $query .= ($this->purchase->getHasInvoice() != null) ? 'hasInvoice,' : '';
            $query .= ($this->purchase->getRegisterId() != null) ? 'registerId,' : '';
            $query .= ($this->purchase->getInstallmentNumber() != null) ? 'installmentNumber,' : '';
            $query .= ($this->purchase->getPaymentType() != null) ? 'paymentType,' : '';
            $query .= 'date)';
            return $query;
        }

        public function setInsertQueryValues(){

            $query = ' VALUES(';
            $query .= ($this->purchase->getCustomerId() != null) ? $this->purchase->getCustomerId().',' : '';
            $query .= ($this->purchase->getTotalValue() != null) ? $this->purchase->getTotalValue().',' : '';
            $query .= ($this->purchase->getDiscount() != null) ? $this->purchase->getDiscount().',' : '';
            $query .= ($this->purchase->getFinalValue() != null) ? $this->purchase->getFinalValue().',' : '';
            $query .= ($this->purchase->getHasInvoice() != null) ? $this->purchase->getHasInvoice().',' : '0';
            $query .= ($this->purchase->getRegisterId() != null) ? $this->purchase->getRegisterId().',' : '';
            $query .= ($this->purchase->getInstallmentNumber() != null) ? $this->purchase->getInstallmentNumber().',' : '';
            $query .= ($this->purchase->getPaymentType() != null) ? '"'.$this->purchase->getPaymentType().'",' : '';
            $query .=  '"'.date("Y-m-d") .'")';
            return $query;
        }
    }
?>