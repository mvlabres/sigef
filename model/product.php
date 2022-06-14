<?php

class Product{

    private $id;
    private $description;
    private $priceTable;
    private $priceLabel;
    private $barcode;
    private $size;
    private $productFamilyId;
    private $productFamilyDescription;

    private $COUNTRY_CODE = '789';
    private $BUSINESS_CODE = '356';
    private $TOTAL_CODE_NUM_CARACTERS = 6;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getPriceTableId(){
        return $this->priceTableId;
    }

    public function setPriceTableId($priceTableId){
        $this->priceTableId = $priceTableId;
    }

    public function getBarcode(){
        return $this->barcode;
    }

    public function setBarcode(){

        if($this->getId() == '' || $this->getId() == null) return;

        $numCaracters = $this->TOTAL_CODE_NUM_CARACTERS - strlen($this->getId());
        $codeWithZeros = '';

        for ($cont = 0; $cont < $numCaracters; $cont++) {
            $codeWithZeros .= '0';
        }

        $this->barcode = $this->COUNTRY_CODE . $this->BUSINESS_CODE . $codeWithZeros . strval($this->getId());
    }

    public function getSize(){
        return $this->size;
    }

    public function setSize($size){
        $this->size = $size;
    }

    public function getProductFamilyId(){
        return $this->productFamilyId;
    }

    public function setProductFamilyId($productFamilyId){
        $this->productFamilyId = $productFamilyId;
    }
}

?>

