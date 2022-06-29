<?php

class CardFee{

    private $id;
    private $installmentNumber;
    private $fee;
    private $applicableFee;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getInstallmentNumber(){
        return $this->installmentNumber;
    }

    public function setInstallmentNumberd($installmentNumber){
        $this->installmentNumber = $installmentNumber;
    }

    public function getFee(){
        return $this->fee;
    }

    public function setFee($fee){
        $this->fee = floatval($fee);
    }

    public function setApplicableFee($applicableFee){
        $this->applicableFee = $applicableFee;
    }

    public function getApplicableFee(){
        return $this->applicableFee;
    }
}
?>