<?php

    require('../controller/productController.php');

    $productController = new ProductController(null);

    $relationship = $productController->findRelationship();
   
?>

<html>

<body onload="handleProductLoad()">
    <article class="slds-card">
        <div class="slds-card__header slds-grid">
            <header class="slds-media slds-media_center slds-has-flexi-truncate">
                <div class="slds-media__figure">
                    <span class="slds-icon_container slds-icon-standard-account" title="account">
                        <span class="slds-assistive-text"></span>
                    </span>
                </div>
                <div class="slds-media__body">
                    <h2 class="slds-card__header-title">
                        <a href="#" class="slds-card__header-link slds-truncate" title="Accounts">
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
                            <input name="description" type="text" class="slds-input" required />
                        </div>
                    </div>
                    <div class="slds-grid slds-grid_align-start field-group">
                        <div class="slds-form-element slds-size_1-of-3">
                            <label class="slds-form-element__label">Tamanho</label>
                            <div class="slds-form-element__control">
                                <input name="size" type="text" class="slds-input" required />
                            </div>
                        </div>
                        <div class="slds-form-element slds-size_1-of-3">
                            <div class="slds-form-element">
                                <label class="slds-form-element__label" for="select-01">Famíla do produto</label>
                                <div class="slds-form-element__control">
                                    <div class="slds-select_container">
                                        <select class="slds-select" id="select-01">
                                            <option value="">Selecione uma opção</option>
                                            <option value="">Option One</option>
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
                        <div class="slds-form-element slds-size_1-of-2">
                            <label class="slds-form-element__label" for="select-01">Grupo de precificação</label>
                            <div class="slds-form-element__control">
                                <div class="slds-select_container">
                                    <select class="slds-select" id="select-01">
                                        <option value="">Selecione uma opção</option>

                                        <?php  
                                        
                                        foreach($relationship['priceTable'] as $priceTable){
                                            echo '<option value"'. $priceTable->getId() .'">Preço de custo R$ '. $priceTable->getCostPrice() .' - Preço final R$ '. $priceTable->getFinalPrice() .'</option>';  
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="slds-form-element slds-size_1-of-2">
                            <button class="slds-button slds-button_brand">Novo</button>
                        </div>
                    </div>

                    <div id="readOnly" class="readonly-group-field">
                        <div class="slds-grid slds-grid_align-start field-group">
                            <div class="slds-form-element slds-size_1-of-5">
                                <label class="slds-form-element__label">Custo fixo</label>
                                <div class="slds-form-element__control">
                                    <input name="size" type="currency" class="slds-input" readonly />
                                </div>
                            </div>
    
                            <div class="slds-form-element slds-size_1-of-5">
                                <label class="slds-form-element__label">Custo variável</label>
                                <div class="slds-form-element__control">
                                    <input name="size" type="currency" class="slds-input" readonly />
                                </div>
                            </div>
    
                            <div class="slds-form-element slds-size_1-of-5">
                                <label class="slds-form-element__label">Custo unt</label>
                                <div class="slds-form-element__control">
                                    <input name="size" type="currency" class="slds-input" readonly />
                                </div>
                            </div>
    
                            <div class="slds-form-element slds-size_1-of-5">
                                <label class="slds-form-element__label">Custo total</label>
                                <div class="slds-form-element__control">
                                    <input name="size" type="currency" class="slds-input" readonly />
                                </div>
                            </div>
                        </div>
    
                        <div class="slds-form-element slds-size_1-of-3">
                            <label class="slds-form-element__label">Preço final</label>
                            <div class="slds-form-element__control">
                                <input id="finalPrice" name="size" type="currency" class="slds-input" readonly />
                            </div>
                        </div>
    
                        <div class="slds-form-element slds-size_1-of-3">
                            <label class="slds-form-element__label">Código de barras</label>
                            
                            <div class="bar-code">
                                <svg  style=" margin-top: 10px;" id="barcode"></svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="button-action" role="group">
                        <a href="home.php" class="slds-button slds-button_neutral">Cancelar</a>
                        <button id="priceSave" class="slds-button slds-button_brand" type="submit">Salvar</button>
                    </div>
                </div>

                <input name="action" value="" type="hidden" />

            </form>
        </div>
    </article>
</body>

</html>