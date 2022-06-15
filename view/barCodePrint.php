<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

    require_once('../controller/session.php');
    require_once('../controller/printBarcodeController.php');

    if($_SESSION['name'] == null){
        header('LOCATION:login.php');
    }

    $barcodeValue = '';
    $productId = '';
    $product = '';

    $printBarcodeController = new PrintBarcodeController();

    

    if(isset($_GET['barcode'])){
        $barcodeValue = $_GET['barcode'];
        $productId = $_GET['productId'];

        $product = $printBarcodeController->findById($productId);
    }


?>

<html>

    <head>
        <link rel="stylesheet"
            href="node_modules/@salesforce-ux/design-system/assets/styles/salesforce-lightning-design-system.min.css" />
        <link rel="stylesheet" href="custom-css/style.css" />
        <script src="JS/controller.js"></script>
        <script src="JS/JsBarcode.all.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="JS/JsBarcode.all.min.js"></script>
    </head>

    
    <body class="body-print" onload="handlePrintLoad()">

        <div class="print-container printable">
            <input id="barcodeData" value="<?php echo $barcodeValue; ?>" type="hidden" />

            <div>
                <?php echo '<div class="print-value-size slds-text-body_small">'.$product->getDescription().'</div>'; ?>
            </div>

            <div class="print-label-container" >
                <?php echo '<div class="print-value-size slds-text-heading_small"> Tam.: '.$product->getSize().'</div>'; ?>
                <?php echo '<div class="print-value-price slds-text-heading_small">R$ '.$product->getFinalPrice().'</div>'; ?>
            </div>
    
            <svg id="barcode"></svg>
            <p id="feedback"></p>
        </div>
    </body>
</html>