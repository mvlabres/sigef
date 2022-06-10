<?php

    require('../controller/priceTableController.php');

    $priceTableController = new PriceTableController(null);
    $priceTable = $priceTableController->newInstance();

    if(isset($_POST['action'])){

        $action = $_POST['action'];

        switch ($action) {
            case 'save':{
                
                $priceTableController = new PriceTableController($_POST);
        
                if($priceTableController->create()){
                    $priceTable = $priceTableController->newInstance();
                    header('Location: home.php?content=priceTableView.php&messageType=price-table-success');
                }
                break;
            }
                
            case 'calculate': {
                $priceTableController = new PriceTableController($_POST);
                $priceTable = $priceTableController->calculate();
                break;
            }
        }       
    }

?>

<html>

<body onload="handlePriceLoad()">
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
                            <span>Tabela de preço</span>
                        </a>
                    </h2>
                </div>
            </header>
        </div>
        <div class="card-body">
            <h2 id="element-with-table-label" class="slds-text-heading_medium slds-m-bottom_xx-small">Cadastro de tabela de preço</h2>
            <form method="post" action="#" onsubmit="return handleCurrencySubmit()" >
                <div class="slds-form-element">
                    <div class="slds-grid slds-grid_align-start field-group">

                        <input value="<?php if($priceTable->getId() != null) echo $priceTable->getId(); ?>" name="id" type="hidden" />

                        <div class="slds-form-element slds-size_1-of-4">
                            <label class="slds-form-element__label">Preço de custo</label>
                            <div class="slds-form-element__control">
                                <input value="<?php if($priceTable->getCostPrice() != null) echo $priceTable->getCostPrice(); ?>" name="costPrice" type="currency" class="slds-input"  required /> 
                            </div>
                        </div>

                        <div class="slds-form-element slds-size_1-of-4">
                            <label class="slds-form-element__label">Custo unt.</label>
                            <div class="slds-form-element__control">
                                <input value="<?php if($priceTable->getUnitCost() != null) echo $priceTable->getUnitCost(); ?>" name="unitCost" type="currency" class="slds-input" required />
                            </div>
                        </div>
                        <div class="slds-form-element slds-size_1-of-4">
                            <label class="slds-form-element__label">Custo Variável</label>
                            <div class="slds-form-element__control">
                                <input value="<?php if($priceTable->getVariableCost() != null) echo $priceTable->getVariableCost(); ?>" name="variableCost" type="currency" class="slds-input" required />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="slds-form-element">
                    <div class="slds-grid slds-grid_align-start field-group">
                        <div class="slds-form-element slds-size_1-of-3">
                            <label class="slds-form-element__label">Custo fixo</label>
                            <div class="slds-form-element__control">
                                <input value="<?php if($priceTable->getFixedCost() != null) echo $priceTable->getFixedCost(); ?>" name="fixedCost" type="currency" class="slds-input" required />
                            </div>
                        </div>
                        <div class="slds-form-element slds-size_1-of-3">
                            <label class="slds-form-element__label">Markup (%)</label>
                            <div class="slds-form-element__control">
                                <input value="<?php if($priceTable->getMarkup() != null) echo $priceTable->getMarkup(); ?>" name="markup" type="number" class="slds-input" required />
                            </div>
                        </div>

                        <input id="action" type="hidden" name="action" value=""/>

                        <div class="slds-form-element">
                            <input type="hidden" name="calculate" value="calculate"/>
                            <button class="slds-button slds-button_brand" type="submit" onclick="return onPriceSubmit('calculate')" >Calcular</button>
                        </div>
                    </div>
                </div>

                <div class="readonly-group-field">
                    <div class="slds-grid slds-grid_align-start field-group">
                        <div class="slds-form-element slds-size_1-of-5">
                            <label class="slds-form-element__label">Custo Total</label>
                            <div class="slds-form-element__control">
                                <input value="<?php if($priceTable->getTotalCost() != null) echo $priceTable->getTotalCost(); ?>" name="totalCost" type="currency" class="slds-input readonly" readonly />
                            </div>
                        </div>

                        <div class="slds-form-element slds-size_1-of-5">
                            <label class="slds-form-element__label">Margem de lucro (%)</label>
                            <div class="slds-form-element__control">
                                <input value="<?php if($priceTable->getProfitMargin() != null) echo $priceTable->getProfitMargin(); ?>" name="profitMargin" type="number" class="slds-input readonly" readonly />
                            </div>
                        </div>

                        <div class="slds-form-element slds-size_1-of-5">
                            <label class="slds-form-element__label">Lucro (R$)</label>
                            <div class="slds-form-element__control">
                                <input value="<?php if($priceTable->getProfit() != null) echo $priceTable->getProfit(); ?>" name="profit" type="currency" class="slds-input readonly" readonly />
                            </div>
                        </div>

                        <div class="slds-form-element slds-size_1-of-5">
                            <label class="slds-form-element__label">Preço final</label>
                            <div class="slds-form-element__control">
                                <input id="finalPrice" value="<?php if($priceTable->getFinalPrice() != null) echo $priceTable->getFinalPrice(); ?>" name="finalPrice" type="currency" oninput="handleFinalPriceChange()" class="slds-input readonly" readonly />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="slds-form-element">
                    <div class="button-action" role="group">
                        <a href="home.php" class="slds-button slds-button_neutral">Cancelar</a>
                        <button id="priceSave" class="slds-button slds-button_brand" type="submit" onclick="return onPriceSubmit('save')">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </article>
</body>

</html>