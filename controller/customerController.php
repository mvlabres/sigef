<?php

include_once('../repositorys/customerRepository.php');
include_once('../model/customer.php');

class CustomerController{

    private $customer;
    private $post;
    private $customerRepository;
    
    public function init(){
        $this->customer = new Customer();
        $this->customerRepository = new CustomerRepository();
    }

    public function __construct($post){

        $this->init();

        if(!$post) return;
        $this->post = $post;
    }

    public function newInstance(){
        return new Customer();
    }

    public function findByCpf($cpf){

        $result = $this->customerRepository->findByCpf($cpf);
        $customers = $this->getResultValues($result);

        if(count($customers) > 0) return $customers[0];
        else return new Customer();
    }

    public function create(){

        $this->customer->setName($this->post['name']);
        $this->customer->setCpf($this->post['cpf']);
        $this->customer->setTel($this->post['tel']);

        $this->customerRepository->setCustomer($this->customer);
        return $this->customerRepository->create();
    }

    public function getResultValues($result){

        $customers = array();

        while ($data = $result->fetch_assoc()){ 
            $customer = new Customer();
            $customer->setId($data['id']);
            $customer->setName($data['name']);
            $customer->setTel($data['tel']);
            $customer->setCpf($data['cpf']); 

            array_push($customers, $customer);
        }

        return $customers;
    }
}

?>