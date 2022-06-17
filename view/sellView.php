<?php
    $registerId = '123456';
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
                        <a href="#" class="slds-card__header-link slds-truncate">
                            <span>Venda</span>
                        </a>
                    </h2>
                </div>
                <div class="slds-no-flex">
                    <button class="slds-button slds-button_brand">Fechar Caixa</button>
                </div>
            </header>
        </div>
        <div class="card-body">
            <?php if(!$registerId){
                    echo ' 
                        <div>
                            <button class="slds-button slds-button_brand">Abrir Caixa</button>
                        </div>
                    </div>
                </article>';
                } else {
                    echo ' 

                <div class="sell-container">
                    <div class="sell-details slds-size_3-of-5">
                        <div class="slds-grid">
                            <div class="full-start">
                                <div class="slds-grid">
                                    <div class="slds-form-element slds-size_2-of-3">
                                        <label class="slds-form-element__label">Código de barras</label>
                                        <div class="slds-form-element__control">
                                            <input id="codebar" name="codebar" type="text" tabindex="0" class="slds-input" value="" oninput="handleInput()" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

                                <div class="slds-form-element slds-size_1-of-1">
                                    <div class="slds-form-element slds-size_1-of-2 input-group">
                                        <label class="slds-form-element__label">Total recebido</label>
                                        <div>
                                            <input id="receiptValue" name="receiptValue" type="number" tabindex="0" value="" onblur="handleBarcodeBlur()" />
                                        </div>
                                    </div>
                                    
                                    <div class="slds-form-element slds-size_1-of-2 input-group">
                                        <label class="slds-form-element__label">Troco</label>
                                        <div>
                                            <input id="codebar" name="codebar" type="number" tabindex="0" value="" onblur="handleBarcodeBlur()" readonly />
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
                                            <select value="" name="productFamily" class="slds-select" id="productFamily" required>
                                                <option value="">Selecione uma opção</option>
                                                <option value="">Crédito</option>
                                                <option value="">Débito</option>
                                                <option value="">Pix</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="slds-grid slds-grid_align-spread row-align-bottom">
                                    <div class="slds-form-element">
                                        <label class="slds-form-element__label" for="productFamily">N° de parcelas</label>
                                        <div class="slds-form-element__control">
                                            <div class="slds-select_container">
                                                <select value="" name="productFamily" class="slds-select" id="productFamily" disabled>
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
                                                <input type="checkbox" name="options" id="checkbox-unique-id-80" value="checkbox-unique-id-80" />
                                                <label class="slds-checkbox__label" for="checkbox-unique-id-80">
                                                    <span class="slds-checkbox_faux"></span>
                                                    <span class="slds-form-element__label">Nota Fiscal</span>
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
                            <button class="slds-button slds-button_brand" type="submit">Salvar</button>
                            <button class="slds-button slds-button_brand" type="submit">Fechar Pedido</button>
                        </div>
                      </footer>
                </article>';
                }
                ?>
</body>

</html>