<?php
    require('../connection.php');

    $productCode = $_POST['data'];

    $result = findStockByProductCode($productCode);

    if(!$result) return null;

    echo json_encode(setFieldsResult($result));

    function findStockByProductCode($productCode){

        try{

            $conn = new Connection();

            $sql = "SELECT Stock.id, entryDate, departureDate, quantity, productId, productCode, Product.description AS product, Price.finalPrice AS final_Price
                    FROM Stock 
                    INNER JOIN Product ON productId = Product.id
                    INNER JOIN Price ON priceID = Price.id
                    WHERE productCode = '".$productCode."' AND quantity > 0";

            $result = $conn->mySqli->query($sql);
            return $result;

        }catch(Exception $e){
            return false;
        }
    }

    function setFieldsResult($searchResult){
        return $searchResult->fetch_assoc();
    }
?>