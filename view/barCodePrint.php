<?php

    require('../controller/session.php');
    require_once('../controller/printBarcodeController.php');

    if($_SESSION['name'] == null){
        header('LOCATION:login.php');
    }


    $barcodeValue = '';
    $priceId = '';
    $priceTable = '';

    $printBarcodeController = new PrintBarcodeController();

    if(isset($_GET['barcode'])){
        $barcodeValue = $_GET['barcode'];
        $priceId = $_GET['priceid'];

        $priceTable = $printBarcodeController->findById($priceId);
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

            <div class="print-label-container" >
                <?php echo '<div class="print-value-size slds-text-heading_small">Tam. GG</div>'; ?>
                <?php echo '<div class="print-value-price slds-text-heading_small">R$ '.$priceTable->getFinalPrice().'</div>'; ?>
            </div>
    
            <svg id="barcode"></svg>
            <p id="feedback"></p>
        </div>
    </body>
</html>