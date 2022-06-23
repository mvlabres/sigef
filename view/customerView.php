<?php


    require('../controller/customerController.php');
    
    $goToSell = false;
    if(isset($_GET['from'])) $goToSell = true;

    if(isset($_POST['action'])) {

        $customerController;

        $action = $_POST['action'];

        
        if($action == 'save') {
            
            $customerController = new CustomerController($_POST);
            $customerId = $customerController->create();


            if($customerId){

                if($goToSell) header('Location: home.php?content=sellView.php&customer-id='.$customerId.'&messageType=customer-success');

                else header('Location: home.php?content=customerView.php&messageType=customer-success');
            }else {

                if($goToSell) header('Location: home.php?content=sellView.php&messageType=customer-error');

                else header('Location: home.php?content=customerView.php&messageType=customer-error');
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
                            <span>Clientes</span>
                        </a>
                    </h2>
                </div>
            </header>
        </div>
        <div class="card-body">
            <h2 id="element-with-table-label" class="slds-text-heading_medium slds-m-bottom_xx-small">Cadastro de clientes</h2>
            <form method="post" action="#">
                <div class="slds-form-element">
                    <label class="slds-form-element__label" for="form-element-01">Nome</label>
                    <div class="slds-form-element__control">
                        <input name="name" type="text" id="form-element-01" class="slds-input" required/>
                    </div>
                </div>

                <div class="slds-grid slds-grid_align-start cutomer-docs">
                    <div class="slds-form-element slds-size_1-of-4">
                        <label class="slds-form-element__label" for="form-element-01">CPF</label>
                        <div class="slds-form-element__control">
                            <input name="cpf" name="description" type="text" id="form-element-01" class="slds-input" onkeyup="applyMask(this)" required/>
                        </div>
                    </div>
    
                    <div class="slds-form-element slds-size_1-of-4">
                        <label class="slds-form-element__label" for="form-element-01">Telefone</label>
                        <div class="slds-form-element__control">
                            <input name="tel" name="description" type="text" id="form-element-01" class="slds-input" onkeyup="applyMask(this)" required/>
                        </div>
                    </div>
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