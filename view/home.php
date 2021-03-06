<?php
    error_reporting(E_ERROR | E_PARSE);

    require('../utils/toast.php');
    require('../controller/session.php');

    if($_SESSION['name'] == null){
        header('LOCATION:login.php');
    }

    $content = '';
    $toastContent = '';

    if(isset($_GET['content'])) {

        $content = $_GET['content'];
        
        if($content == 'logout') {
            session_destroy();
            header('Location:login.php');
        }
    }

    if(isset($_GET['messageType'])){
        $messageType = $_GET['messageType'];

        $toast = new Toast();

        $toastContent = $toast->showToast($messageType);

    }
?>

<html>

<head>
    <link rel="stylesheet" href="node_modules/@salesforce-ux/design-system/assets/styles/salesforce-lightning-design-system.min.css" />
    <link rel="stylesheet" href="custom-css/style.css" />
    <script src="JS/controller.js"></script>
    <script src="JS/JsBarcode.all.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="JS/JsBarcode.all.min.js"></script>
</head>

<body>
    <?php if($toastContent != '') {
        echo $toastContent; 
        echo '<script> closeToastTimer(); </script>'; 
    }?>
    <div class="header">
        <div>
            <img src="img/logos/logo.png">
        </div>
    </div>

    <div class="body-container">
        <div class="menu">
            <nav class="slds-nav-vertical slds-nav-vertical_shade" aria-label="Sub page">
                <div class="slds-nav-vertical__section">
                    <h2 id="entity-header" class="slds-nav-vertical__title">Cadastros</h2>
                    <ul aria-describedby="entity-header">
                        <li class="slds-nav-vertical__item  menu-item">
                            <a href="home.php?content=customerView.php" class="slds-nav-vertical__action">Cliente</a>
                        </li>
                        <li class="slds-nav-vertical__item  menu-item">
                            <a href="home.php?content=stockView.php" class="slds-nav-vertical__action">Estoque</a>
                        </li>
                        <li class="slds-nav-vertical__item  menu-item">
                            <a href="home.php?content=productFamilyList.php" class="slds-nav-vertical__action">Fam??lia de produtos</a>
                        </li>
                        <li class="slds-nav-vertical__item menu-item">
                            <a href="home.php?content=productList.php" class="slds-nav-vertical__action" >Produtos</a>
                        </li>
                        <li class="slds-nav-vertical__item  menu-item">
                            <a href="home.php?content=priceTableList.php" class="slds-nav-vertical__action">Tabela de precifica????o</a>
                        </li>
                    </ul>
                    <h2 id="entity-header" class="slds-nav-vertical__title">Vendas</h2>
                    <ul aria-describedby="entity-header">
                        <li class="slds-nav-vertical__item  menu-item">
                            <a href="home.php?content=sellView.php" class="slds-nav-vertical__action">Venda</a>
                        </li>
                        <li class="slds-nav-vertical__item  menu-item">
                            <a href="home.php?content=registerList.php" class="slds-nav-vertical__action">caixa</a>
                        </li>
                        <li class="slds-nav-vertical__item  menu-item">
                            <a href="home.php?content=feeSimulator.php" class="slds-nav-vertical__action">Simulador de taxas</a>
                        </li>
                    </ul>
                    <h2 id="entity-header" class="slds-nav-vertical__title">LogOut</h2>
                    <ul aria-describedby="entity-header">
                        <li class="slds-nav-vertical__item menu-item">
                            <a href="home.php?content=logout" class="slds-nav-vertical__action">Sair</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="content-body">
            <?php
                if($content) include($content);
            ?>
        </div>
    </div>
</body>
</html>