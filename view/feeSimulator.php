<?php
    require('../controller/cardFeeController.php');

    $cardFeeController = new CardFeeController();

    $fees = $cardFeeController->findAll();

    if(!$fees) header('home.php?content=feeSimulator.php&messageType=simulator-error');
    
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
                            <span>Simulador de taxas</span>
                        </a>
                    </h2>
                </div>
            </header>
        </div>
        <div class="card-body">
            <div class="slds-grid slds-grid_align-start field-group">
                <div class="slds-form-element slds-size_1-of-3">
                    <label class="slds-form-element__label">Valor da compra</label>
                    <div class="slds-form-element__control">
                        <input id="payment" name="productCode" type="number" tabindex="0" class="slds-input" />
                    </div>
                </div>
                <div class="slds-form-element slds-size_1-of-3">
                    <button class="slds-button slds-button_brand" type="button" onclick="handleFeeCalculator()">Calcular</button>
                </div>
            </div>

            <div class="sell-confirm">
                <table id="cardFeeTable" class="slds-table slds-table_cell-buffer slds-table_bordered slds-size_1-of-3"
                    aria-labelledby="element-with-table-label other-element-with-table-label">
                    <thead>
                        <tr class="slds-line-height_reset">
                            <th class="" scope="col">
                                <div class="slds-truncate">Parcela</div>
                            </th>
                            <th class="" scope="col">
                                <div class="slds-truncate">Taxa</div>
                            </th>
                            <th class="" scope="col">
                                <div class="slds-truncate">Taxa aplicada</div>
                            </th>
                            <th class="" scope="col">
                                <div class="slds-truncate">Valor</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
    
                            foreach($fees as $fee) { 
                                echo '<tr class="slds-hint-parent">';
                                echo '<td scope="row"><div class="slds-truncate" name="installmentNumber[]">'. $fee->getInstallmentNumber() .'</div></td>';
                                echo '<td scope="row"><div class="slds-truncate" name="feeValue[]">'. $fee->getFee() .'</div></td>';
                                echo '<td scope="row"><div class="slds-truncate" name="fee[]">'. $fee->getApplicableFee() .'</div></td>';
                                echo '<td><div class="slds-truncate" name="paymentValue[]"></div></td>';
                                echo '</tr>';
                            }
                            ?>
        
                    </tbody>
                </table>
            </div>
        </div>
    </article>
</body>

</html>