<?php

class RegisterResume{

    private $purchaseQuantity;
    private $purchaseCreditTotalValue;
    private $purchaseDebitTotalValue;
    private $purchasePixTotalValue;
    private $purchaseCashTotalValue;
    private $registerInitialValue;
    private $totalValue;

    public function getPurchaseQuantity(){
        return $this->purchaseQuantity;
    }

    public function setPurchaseQuantity($purchaseQuantity){
        $this->purchaseQuantity = $purchaseQuantity;
    }

    public function getPurchaseCreditTotalValue(){
        return $this->purchaseCreditTotalValue;
    }

    public function setPurchaseCreditTotalValue($purchaseCreditTotalValue){
        $this->purchaseCreditTotalValue = floatval($purchaseCreditTotalValue);
    }

    public function getPurchaseDebitTotalValue(){
        return $this->purchaseDebitTotalValue;
    }

    public function setPurchaseDebitTotalValue($purchaseDebitTotalValue){
        $this->purchaseDebitTotalValue = floatval($purchaseDebitTotalValue);
    }

    public function getPurchasePixTotalValue(){
        return $this->purchasePixTotalValue;
    }

    public function setPurchasePixTotalValue($purchasePixTotalValue){
        $this->purchasePixTotalValue = floatval($purchasePixTotalValue);
    }

    public function getPurchaseCashTotalValue(){
        return $this->purchaseCashTotalValue;
    }

    public function setPurchaseCashTotalValue($purchaseCashTotalValue){
        $this->purchaseCashTotalValue = floatval($purchaseCashTotalValue);
    }

    public function getRegisterInitialValue(){
        return $this->registerInitialValue;
    }

    public function setRegisterInitialValue($registerInitialValue){
        $this->registerInitialValue = floatval($registerInitialValue);
    }

    public function getTotalValue(){
        return $this->totalValue;
    }

    public function setTotalValue($totalValue){
        $this->totalValue = floatval($totalValue);
    }
}
?>