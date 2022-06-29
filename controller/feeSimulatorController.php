<?php

    include_once('../repositorys/feeSimulatorRepository.php');
    include_once('../model/feeSimulator.php');

    class ProductController{

        private $fee;
        private $feeSimulatorRepository;

        public function __construct($post){

            $this->fee = new Fee();
            $this->feeSimulatorRepository = new FeeSimulatorRepository();
        }

        public function findAll(){

            $result = $this->feeSimulatorRepository->findAll();

            return $this->getResultValues($result);
        }


        public function getResultValues($result){

            $fee = new Fee();
            $fees = array();

            while ($data = $result->fetch_assoc()){ 
                $fee = new Fee();
                $fee->setId($data['id']);
                $fee->setInstallmentNumber($data['installmentNumber']);
                $fee->setFee($data['fee']);
                $fee->setApplicableFee($data['applicableFee']);

                array_push($fees, $fee);

            }
            return $fees;
        }
    }
?>