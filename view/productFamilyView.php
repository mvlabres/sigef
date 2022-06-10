<?php

    require('../controller/productFamilyController.php');
    
    if(isset($_POST['action'])) {

        $productFamilyController;
        
        print_r($_POST);
        $action = $_POST['action'];
        
        if($action == 'save') {
            
            $productFamilyController = new ProductFamilyController($_POST);
            $result = $productFamilyController->create();

            if($result){
                header('Location: home.php?content=productFamilyList.php&messageType=product-family-success');
            }
        }
    }
?>

<html>

<body>
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
                            <span>Família de produtos</span>
                        </a>
                    </h2>
                </div>
            </header>
        </div>
        <div class="card-body">
            <h2 id="element-with-table-label" class="slds-text-heading_medium slds-m-bottom_xx-small">Cadastro de família de produtos</h2>
            <form method="post" action="#">
                <div class="slds-form-element">
                    <label class="slds-form-element__label" for="form-element-01">Descrição</label>
                    <div class="slds-form-element__control">
                        <input name="description" type="text" id="form-element-01" class="slds-input" required/>
                    </div>

                    <input name="action" value="save" type="hidden" />

                    <div class="button-action" role="group">
                        <a href="home.php" class="slds-button slds-button_neutral">Cancelar</a>
                        <button class="slds-button slds-button_brand" type="submit">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </article>
</body>

</html>