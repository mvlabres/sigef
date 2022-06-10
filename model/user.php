<?php
class User{

    private $id;
    private $name;
    private $password;
    private $email;
    private $ruleId;
    private $ruleDescription;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setName($name){
        $this->nome = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setRuleId($ruleId){
        $this->ruleId = $ruleId;
    }

    public function getRuleId(){
        return $this->ruleId;
    }
}
?>