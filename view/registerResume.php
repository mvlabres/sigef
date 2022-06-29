<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    include('../controller/registerController.php');
    include_once('../controller/purchaseController.php');

    $purchaseController = new PurchaseController(null);
    $registerController = new RegisterController(null);

    if(isset($_GET['id'])){

        $id = $_GET['id'];

        $purchaseResume = $purchaseController->findPurchaseResumeByRegisterId($id);
    }

    if(isset($_POST['close'])){
        if($registers = $registerController->close($id)){
            header('home.php?content=registerList.php&message=register-success');
        }else{
            header('home.php?content=registerList.php&message=register-error');
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
                            <span>Fechamento de Caixa</span>
                        </a>
                    </h2>
                </div>
            </header>
        </div>
        <div class="card-body">
            <form method="post" action="#">
                <div class="slds-form-element">
                    <label class="slds-form-element__label" for="form-element-01">Total de pedidos</label>
                    <div class="slds-form-element__control">
                        <input value="<?php echo $purchaseResume->getPurchaseQuantity(); ?>" type="number" class="slds-input readonly" readonly />
                    </div>
                </div>

                <div class="slds-form-element input-group slds-size_1-of-4">
                    <label class="slds-form-element__label" for="form-element-01">Caixa inicial</label>
                    <div class="slds-form-element__control">
                        <input value="<?php echo $purchaseResume->getRegisterInitialValue(); ?>" type="currency"  readonly />
                    </div>
                </div>

                <div class="register-values">
                    <div class="slds-grid slds-grid_align-space">
                        <div class="slds-form-element input-group slds-size_1-of-3">
                            <label class="slds-form-element__label" for="form-element-01">Total de vendas no débito</label>
                            <div class="slds-form-element__control">
                                <input value="<?php echo $purchaseResume->getPurchaseDebitTotalValue(); ?>" type="currency" readonly />
                            </div>
                        </div>
    
                        <div class="slds-form-element input-group slds-size_1-of-3">
                            <label class="slds-form-element__label" for="form-element-01">Total de vendas no crédito</label>
                            <div class="slds-form-element__control">
                                <input value="<?php echo $purchaseResume->getPurchaseCreditTotalValue(); ?>" type="currency" readonly />
                            </div>
                        </div>
                    </div>
    
    
                    <div class="slds-grid slds-grid_align-space">
                        <div class="slds-form-element input-group slds-size_1-of-3">
                            <label class="slds-form-element__label" for="form-element-01">Total de vendas no pix</label>
                            <div class="slds-form-element__control">
                                <input value="<?php echo $purchaseResume->getPurchasePixTotalValue(); ?>" type="currency" readonly />
                            </div>
                        </div>
        
                        <div class="slds-form-element input-group slds-size_1-of-3">
                            <label class="slds-form-element__label" for="form-element-01">Total de vendas no dinheiro</label>
                            <div class="slds-form-element__control">
                                <input value="<?php echo $purchaseResume->getPurchaseCashTotalValue(); ?>" type="currency"  readonly />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="slds-form-element input-group slds-size_1-of-4">
                    <label class="slds-form-element__label" for="form-element-01">Valor total das vendas</label>
                    <div class="slds-form-element__control">
                        <input value="<?php echo $purchaseResume->getTotalValue(); ?>" type="currency" readonly />
                    </div>
                </div>

                <div id="confirmation-container" class="slds-form-element">
                    <label class="slds-form-element__label" for="form-element-01">Confirmação</label>
                    <div class="slds-form-element__control">
                        <input name="confirmation" id="confirmation" type="text" class="slds-input readonly" placeholder='Digite "fechar"' onkeyup="handleConfirmationKeyup()" required />
                    </div>
                </div>

                <input name="close" value="close" type="hidden" />

                <div class="button-action" role="group">
                    <a href="home.php" class="slds-button slds-button_neutral">Cancelar</a>
                    <button id="close-register-button" class="slds-button slds-button_brand" type="submit" onclick="handleCloseRegister()" disabled>Fechar</button>
                </div>
               
            </form>
        </div>
    </article>
</body>

</html>

<html>
    <body>

        <p>Valor total das vendas</p>
        <p><?php echo $purchaseResume->getTotalValue() ?></p>
    </body>
</html>