<?php

    class Register{

        private $id;
        private $status;
        private $openDate;
        private $closeDate;
        private $totalPayments;
        
        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getStatus(){
            return $this->status;
        }

        public function setStatus($status){
            $this->status = $status;
        }

        public function getOpenDate(){
            return $this->openDate;
        }

        public function setOpenDate($openDate){
            $this->openDate = $openDate;
        }

        public function getCloseDate(){
            return $this->closeDate;
        }

        public function setCloseDate($closeDate){
            $this->closeDate = $closeDate;
        }

        public function getTotalPayments(){
            return $this->totalPayments;
        }

        public function setTotalPayments($totalPayments){
            $this->totalPayments = $totalPayments;
        }
    }
?>