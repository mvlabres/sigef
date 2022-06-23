<?php

    require_once('../controller/productController.php');
    require_once('../model/product.php');
    require_once('../utils/toast.php');

    

    $product = new Product();
    $productController = new ProductController(null);
    $toast = new Toast();

    $relationship = $productController->findRelationship();

    if(isset($_POST['action'])){

        $productController = new ProductController($_POST);

        switch ($_POST['action']) {
            case 'save': {

                if($productController->create()) header('Location: home.php?content=productView.php&messageType=product-success&status=success');
                
                else header('Location: home.php?content=productView.php&messageType=product-error');
                
                break;
            }
        }
    }

    if(isset($_GET['status'])){
    
        $product = $productController->getLastCreated();
    }
   
?>

<html>

<body onload="handleProductLoad()">
    <article class="slds-card">
        <div class="slds-card__header slds-grid">
            <header class="slds-media slds-media_center slds-has-flexi-truncate">
                <div class="slds-media__figure">
                    <span class="slds-icon_container slds-icon-standard-account">
                        <span class="slds-assistive-text"></span>
                    </span>
                </div>
                <div class="slds-media__body">
                    <h2 class="slds-card__header-title">
                        <a href="#" class="slds-card__header-link slds-truncate">
                            <span>Produtos</span>
                        </a>
                    </h2>
                </div>
            </header>
        </div>
        <div class="card-body">
            <h2 id="element-with-table-label" class="slds-text-heading_medium slds-m-bottom_xx-small">Cadastro de
                produtos</h2>
            <form method="post" action="#">
                <div class="slds-form-element">
                    <div class="slds-form-element">
                        <label class="slds-form-element__label">Descrição</label>
                        <div class="slds-form-element__control">
                            <input id="description" name="description" type="text" class="slds-input" value="<?php if($product->getDescription() != null) echo $product->getDescription(); ?>" required />
                        </div>
                    </div>
                    <div class="slds-grid slds-grid_align-start field-group">
                        <div class="slds-form-element slds-size_1-of-3">
                            <label class="slds-form-element__label">Tamanho</label>
                            <div class="slds-form-element__control">
                                <input id="size" name="size" type="text" class="slds-input" value="<?php if($product->getSize() != null) echo $product->getSize(); ?>" required />
                            </div>
                        </div>
                        <div class="slds-form-element slds-size_1-of-3">
                            <div class="slds-form-element">
                                <label class="slds-form-element__label" for="productFamily">Famíla do produto</label>
                                <div class="slds-form-element__control">
                                    <div class="slds-select_container">
                                        <select value="" name="productFamily" class="slds-select" id="productFamily" required>
                                            <option value="">Selecione uma opção</option>
                                            <?php
                                            foreach($relationship['productFamily'] as $productFamily){

                                                $selected = '';

                                                if($productFamily->getId() == $product->getProductFamilyId()) $selected = 'selected';
                                                echo '<option value="'.$productFamily->getId().'" '. $selected.'>'.$productFamily->getDescription().'</option>';
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field-group-title">
                        <h2><b>Dados de precificação</b></h2>
                    </div>
                    <div class="slds-grid slds-grid_align-start field-group">
                        <div class="slds-form-element slds-size_5-of-6">
                            <label class="slds-form-element__label" for="priceTable">Grupo de precificação</label>
                            <div class="slds-form-element__control">
                                <div class="slds-select_container">
                                    <select id="priceTable" class="slds-select" name="priceTable" onchange="handlePriceChange()" required>
                                        <option value="">Selecione uma opção</option>

                                        <?php  
                                        
                                        foreach($relationship['priceTable'] as $priceTable){

                                            $selected = '';

                                            if($priceTable->getId() == $product->getPriceTableId()) $selected = 'selected';
                                            echo '<option value="'. $priceTable->getId() .'" '.$selected .'>'. $priceTable->getPriceLabel() .'</option>';  
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="slds-form-element slds-size_1-of-6">
                            <button class="slds-button slds-button_brand">Novo</button>
                        </div>
                    </div>

                    <input id="barcodeData" value="<?php if($product->getBarcode() != null) echo $product->getBarcode(); ?>" type="hidden" />
                    <input id="action" name="action" value="save" type="hidden" />
                    <input id="productId" name="productId" value="<?php if($product->getId() != null) echo $product->getId() ?>" type="hidden" />

                    <div id="barcode-container" class="slds-grid slds-grid_align-center barcode-element">
    
                        <div class="slds-form-element slds-size_1-of-3">
                            <label id="print-label" class="slds-form-element__label">Código de barras</label>
                            
                            <div class="bar-code">
                                <svg  style=" margin-top: 10px;" id="barcode"></svg>
                                <p id="feedback"></p>
                            </div>
                        </div>
                        <?php echo "<a  href='barCodePrint.php?barcode=".$product->getBarcode()."&productId=".$product->getId()."' id='button-print' class='slds-button slds-button_brand'>Imprimir</a>"; ?> 
                    </div>

                    
                    <div class="button-action" role="group">
                        <a href="home.php" class="slds-button slds-button_neutral">Cancelar</a>
                        <button id="priceSave" class="slds-button slds-button_brand" type="submit">Salvar</button>
                    </div>
                </div>


            </form>
        </div>
    </article>
</body>

</html>