<?php

    include_once('../repositorys/registerRepository.php');
    include_once('../model/register.php');

    class RegisterController{

        private $register;
        private $post;
        private $registerRepository;

        public function init(){
            $this->register = new Register();
            $this->registerRepository = new RegisterRepository();
        }

        public function __construct($post){

            $this->init();

            if(!$post) return;
            $this->post = $post;
        }

        public function findById($id){
            
            $result = $this->registerRepository->findById($id);

            $registers =  $this->getResultValues($result);

            if(count($registers) > 0) return $registers[0];
            else return null;
        }
        
        public function findCurrentOpen(){

            try {
                $result = $this->registerRepository->findCurrentOpen('open');
                $today = date("Y-m-d");
    
                if(!$result) return false; 
    
                $registers = $this->getResultValues($result);
    
                if(count($registers) > 0) {

                    $register = $registers[0]; 

                    if($register->getOpenDate() != $today) throw new Exception();
                    
                    return $register;
                }
    
                return false;

            } catch (Exception $ex) {
                header('Location: home.php?content=registerList.php&messageType=has-open-register');
            }
            
        }

        public function createOpen(){

            $register = new Register();
            $this->registerRepository->createOpen();

            return $this->findCurrentOpen();
        }

        public function findAll(){
            $register = new Register();
            $Registers = array();

            $result = $this->registerRepository->findAll();

           return $this->getResultValues($result);
        }

        public function close($id){
            if($this->registerRepository->close($id)){
                header('Location: home.php?content=registerList.php&messageType=register-success');
            } else{
                header('Location: home.php?content=registerList.php&messageType=register-error');
            }
        }

        public function getResultValues($result){

            $registers = array();

            while ($data = $result->fetch_assoc()){ 
                $register = new Register();
                $register->setId($data['id']);
                $register->setStatus($data['status']);
                $register->setOpenDate($data['openDate']);
                $register->setCloseDate($data['closeDate']);
                $register->setTotalPayments($data['totalPayments']); 
                $register->setInitialValue($data['initialValue']); 

                array_push($registers, $register);
            }

            return $registers;
        }
    }
?>