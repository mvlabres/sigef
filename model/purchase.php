<?php

class Purchase{

    private $id;
    private $paymentType;
    private $customerId;
    private $customerName;
    private $totalValue;
    private $discount;
    private $finalValue;
    private $hasInvoice;
    private $registerId;
    private $installmentNumber;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getPaymentType(){
        return $this->paymentType;
    }

    public function setPaymentType($paymentType){
        $this->paymentType = $paymentType;
    }

    public function getCustomerId(){
        return $this->customerId;
    }

    public function setCustomerId($customerId){
        $this->customerId = $customerId;
    }

    public function getCustomerName(){
        return $this->customerName;
    }

    public function setCustomerName($customerName){
        $this->customerName = $customerName;
    }

    public function getTotalValue(){
        return $this->totalValue;
    }

    public function setTotalValue($totalValue){
        $this->totalValue = floatval($totalValue);
    }

    public function getDiscount(){
        return $this->discount;
    }

    public function setDiscount($discount){
        $this->discount = floatval($discount);
    }

    public function getFinalValue(){
        return $this->finalValue;
    }

    public function setFinalValue($finalValue){
        $this->finalValue = floatval($finalValue);
    }

    public function getHasInvoice(){
        return $this->hasInvoice;
    }

    public function setHasInvoice($hasInvoice){
        $this->hasInvoice = ($hasInvoice == null) ? 0 : 1;
    }

    public function getRegisterId(){
        return $this->registerId;
    }

    public function setRegisterId($registerId){
        $this->registerId = $registerId;
    }

    public function getInstallmentNumber(){
        return $this->installmentNumber;
    }

    public function setInstallmentNumber($installmentNumber){
        $this->installmentNumber = ($installmentNumber == null) ? 0 : $installmentNumber;
    }
}
?>