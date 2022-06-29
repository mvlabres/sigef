<?php
include_once('../repositorys/cardFeeRepository.php');
include_once('../model/cardFee.php');

class CardFeeController{
    
    private $cardFee;
    private $cardFeeRepository;

    public function __construct(){
        $this->cardFee = new CardFee();
        $this->cardFeeRepository = new CardFeeRepository();
    }

    public function findAll(){

        $result = $this->cardFeeRepository->findAll();

        if(!$result) return false;

        $cardFees = array();

        while ($data = $result->fetch_assoc()){ 
            $cardFee = new CardFee();
            $cardFee->setId($data['id']);
            $cardFee->setInstallmentNumberd($data['installmentNumber']);
            $cardFee->setFee($data['fee']); 
            $cardFee->setApplicableFee($data['applicableFee']); 

            array_push($cardFees, $cardFee);
        }

        return $cardFees;
    }
}
?>