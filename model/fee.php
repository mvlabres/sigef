<?php

class Fee{

    private $id;
    private $installmentNumber;
    private $fee;
    private $applicableFee;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setInstallmentNumber($installmentNumber){
        $this->installmentNumber = $installmentNumber;
    }

    public function getInstallmentNumber(){
        return $this->installmentNumber;
    }

    public function setFee($fee){
        $this->fee = $fee;
    }

    public function getFee(){
        return $this->fee;
    }

    public function setApplicableFee($applicableFee){
        $this->applicableFee = $applicableFee;
    }

    public function getApplicableFee(){
        return $this->applicableFee;
    }
}
?>