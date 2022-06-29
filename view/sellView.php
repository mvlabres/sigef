<?php

    require_once('../controller/registerController.php');
    require_once('../controller/customerController.php');
    require_once('../controller/purchaseController.php');
    include_once('../model/customer.php');

    $registerController = new RegisterController(null);
    $customerController = new CustomerController(null);
    $purchaseController = new PurchaseController(null);
    $register = '';
    $customer = new Customer();
    $showRegisterCustomerFunction = false;
    $customerValue = null;

    
    if(isset($_POST['products'])){

        $purchaseController = new PurchaseController($_POST);
        if($purchaseController->create()){
            header('Location: home.php?content=sellView.php&messageType=purchase-success'); 
        }else{
            header('Location: home.php?content=sellView.php&messageType=purchase-error'); 
        }
    }

    if(isset($_POST['open-register'])){
        
        $register = $registerController->createOpen();

        if(!$register) header('Location: home.php?content=sellView.php&messageType=register-error');     
    }

    if(isset($_GET['customer-id'])){

        $customerId = $_GET['customer-id'];
        $customer = $customerController->findById($customerId);
    }

    if(isset($_POST['get-customer'])){

        $cpf = $_POST['cpf'];
        $customer = $customerController->findByCpf($cpf);
        $customerId = $customer->getId();

        if(!$customer->getId()) {
            $showRegisterCustomerFunction = true;
            echo '<script> alert("Cliente não cadastrado");</script>';
        }
    }

    $register = $registerController->findCurrentOpen();
?>


<html>

<body>
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
                        <span>Venda</span>
                    </h2>
                </div>


                <?php if(!$register){
                echo ' 
                <div class="slds-no-flex">
                    <form method="post" action="home.php?content=sellView.php">
                        <input type="hidden" name="open-register" value="open-register" />
                        <button type="submit" class="slds-button slds-button_brand">Abrir Caixa</button>
                    </form>
                </div>
            </header>
        </div>
    </article>
     ';
    }
    else {
    echo '
                <div class="slds-no-flex">
                    <button class="slds-button slds-button_brand">Fechar Caixa</button>
                </div>
            </header>
        </div>
        <div class="sell-container">
            <div class="sell-details slds-size_3-of-5">
                <div class="slds-grid">
                    <div class="full-start">
                        <div class="slds-col">
                            <form method="post" action="home.php?content=sellView.php">
                                <div class="slds-grid">
                                    <div class="slds-form-element slds-size_1-of-4">
                                        <label class="slds-form-element__label">CPF cliente</label>
                                        <div class="slds-form-element__control">';
                                            if( $customer->getCpf() != null ) $customerValue = $customer->getCpf();
                                        echo '<input id="cpf" name="cpf" type="text" tabindex="0" class="slds-input" value="'.$customerValue.'" onkeyup="applyMask(this)" required/>
                                        </div>
                                    </div>
                                    <div class="slds-col slds-align-bottom">
                                        <input type="hidden" name="get-customer" /> 
                                        <button class="slds-button slds-button_brand get-customer" type="submit">buscar</button>';
                                        if($showRegisterCustomerFunction) echo'<a href="home.php?content=customerView.php&from=sell-customer" class="slds-button slds-button_brand get-customer" type="submit">Cadastrar</a>';
                              echo '</div>
                                    <div class="slds-col slds-align-bottom">
                                        <div class="slds-text-body_small">' .$customer->getName().'</div>
                                    </div>
                                </div>
                            </form>
                            <div class="slds-form-element slds-size_2-of-3">
                                <label class="slds-form-element__label">Código de barras</label>
                                <div class="slds-form-element__control">
                                    <input id="codebar" name="codebar" type="text" tabindex="0" class="slds-input" value="" oninput="handleInput()" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="order" action="home.php?content=sellView.php" method="post">
                
                <input type="hidden" name="registerId" value="'.$register->getId().'" />
                <input type="hidden" name="customerId" value="'.$customerId.'" /> 
                <table id="productList" name="productList" class="slds-table slds-table_cell-buffer slds-no-row-hover slds-table_bordered products-table">
                    <thead>
                        <tr class="slds-line-height_reset">
                            <th class="td_10" scope="col">
                                <div class="slds-truncate" title="Opportunity Name">N°</div>
                            </th>
                            <th class="td_20" scope="col">
                                <div class="slds-truncate" title="Account Name">Código</div>
                            </th>
                            <th class="td_40" scope="col">
                                <div class="slds-truncate" title="Close Date">Descrição</div>
                            </th>
                            <th class="" scope="col">
                                <div class="slds-truncate" title="Stage">Qtde</div>
                            </th>
                            <th class="td_10" scope="col">
                                <div class="slds-truncate" title="Confidence">Valor</div>
                            </th>
                            <th class="" scope="col">
                                <div class="slds-truncate" title="Contact">Excluir</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div class="slds-grid sell-actions">
                <div class="slds-grid slds-grid_vertical">
                    <div class="sell-price-details">
                        <div class="slds-form-element slds-size_1-of-1 input-group">
                            <label class="slds-form-element__label">Valor total</label>
                            <div>
                                <input id="totalValue" name="totalValue" type="text" tabindex="0" value="" onblur="handleBarcodeBlur()" readonly />
                            </div>
                        </div>

                        <div class="slds-form-element slds-size_1-of-1 discount-field">
                            <div class="slds-form-element slds-size_1-of-4 input-group">
                                <label class="slds-form-element__label">Desconto</label>
                                <div>
                                    <input id="discount" name="discount" type="text" tabindex="0" value="" onblur="handleBarcodeBlur()" readonly />
                                </div>
                            </div>
                            <div class="slds-form-element slds-size_2-of-4 input-group">
                                <label class="slds-form-element__label">Valor final</label>
                                <div>
                                    <input id="finalValue" name="finalValue" type="text" tabindex="0" value="" onblur="handleBarcodeBlur()" readonly />
                                </div>
                            </div>
                        </div>

                        <div class="slds-form-element slds-size_1-of-1">
                            <div class="slds-form-element slds-size_1-of-2 input-group">
                                <label class="slds-form-element__label">Total recebido</label>
                                <div>
                                    <input id="receiptValue" name="receiptValue" type="number" tabindex="0" value="" onkeyup="calculateChangeMoney()" />
                                </div>
                            </div>
                            
                            <div class="slds-form-element slds-size_1-of-2 input-group">
                                <label class="slds-form-element__label">Troco</label>
                                <div>
                                    <input id="changeMoney" name="changeMoney" type="number" tabindex="0" value="" onblur="handleBarcodeBlur()" readonly />
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>

                <div class="slds-grid slds-grid_vertical sell-confirm">
                    <div class="slds-form-element">
                        <div class="slds-form-element">
                            <label class="slds-form-element__label" for="productFamily">tipo de pagamento</label>
                            <div class="slds-form-element__control">
                                <div class="slds-select_container">
                                    <select value="" name="paymentType" class="slds-select" id="paymentType" onchange="handlePaymentTypeChange()" required>
                                        <option value="">Selecione uma opção</option>
                                        <option value="credito">Crédito</option>
                                        <option value="debito">Débito</option>
                                        <option value="dinheiro">Dinheiro</option>
                                        <option value="pix">Pix</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="slds-grid slds-grid_align-spread row-align-bottom">
                            <div class="slds-form-element">
                                <label class="slds-form-element__label" for="productFamily">N° de parcelas</label>
                                <div class="slds-form-element__control">
                                    <div class="slds-select_container">
                                        <select id="installmentNumber" name="installmentNumber" class="slds-select" id="productFamily" disabled="true">
                                            <option value="">Selecione uma opção</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="slds-form-element">
                                <div class="slds-form-element__control">
                                    <div class="slds-checkbox">
                                        <input type="checkbox" name="withInvoice" id="withInvoice" value="withInvoice" />
                                        <label class="slds-checkbox__label" for="withInvoice">
                                            <span class="slds-checkbox_faux"></span>
                                            <span class="slds-form-element__label">Nota Fiscal</span>
                                        </label>
                                    </div>
                                    <div class="slds-checkbox">
                                        <input type="checkbox" name="applyDiscount" id="applyDiscount" value="applyDiscount" onchange="handleDiscountChange(this)" />
                                        <label class="slds-checkbox__label" for="applyDiscount">
                                            <span class="slds-checkbox_faux"></span>
                                            <span class="slds-form-element__label">Aplicar desconto</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
            
        <footer class="slds-card__footer">
            <div class="slds-form-element">
                <button class="slds-button slds-button_neutral">Limpar</button>
                <button class="slds-button slds-button_brand" type="submit" onclick="handleCloseOrder()">Fechar Pedido</button>
            </div>
        </footer>
        </form>
    </div>
</article> ';
}
?>
</body>

</html>