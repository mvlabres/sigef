<?php

    require_once('../controller/productController.php');
    require_once('../model/product.php');
    require_once('../controller/stockController.php');

    $productCode = '';
    $product = new Product();
    $action = 'search';
    $productController = new ProductController(null);
    $stockController = new StockController(null);

    $stocks = $stockController->findAll();

    if(isset($_POST['action'])){
       
        switch ($_POST['action']) {
            case 'search': {

                $productCode = $_POST['productCode'];
                $product = $productController->findByBarcode($productCode);
                break;
            }

            case 'save': {

                echo 'enter save';

                $stockController = new StockController($_POST);

                if($stockController->create()) header('Location: home.php?content=stockView.php&messageType=stock-success');
                else header('Location: home.php?content=stockView.php&messageType=stock-error');
                
                break;
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
                    <span class="slds-icon_container slds-icon-standard-account">
                        <span class="slds-assistive-text"></span>
                    </span>
                </div>
                <div class="slds-media__body">
                    <h2 class="slds-card__header-title">
                        <a href="#" class="slds-card__header-link slds-truncate">
                            <span>Estoque</span>
                        </a>
                    </h2>
                </div>
            </header>
        </div>
        <div class="card-body">
            <h2 id="element-with-table-label" class="slds-text-heading_medium slds-m-bottom_xx-small">Cadastro de produtos em estoque</h2>
            <form id="form" method="post" action="home.php?content=stockView.php">
                <div class="slds-form-element">

                    <div class="slds-grid slds-grid_align-start field-group">
                        <div class="slds-form-element slds-size_1-of-3">
                            <label class="slds-form-element__label">Código de barras</label>
                            <div class="slds-form-element__control">
                                <input id="codebar" name="productCode" type="text" tabindex="0" class="slds-input" value="<?php echo $productCode; ?>" onblur="handleBarcodeBlur()" required />
                            </div>
                        </div>
                        <div class="slds-form-element slds-size_1-of-3">
                            <button class="slds-button slds-button_brand" tabindex="1" type="button">Buscar</button>
                        </div>
                    </div>

                    <div class="slds-grid slds-grid_align-start field-group">
                        <div class="slds-form-element slds-size_1-of-1">
                            <label class="slds-form-element__label">Produto</label>
                            <div class="slds-form-element__control">
                                <input id="product" name="product" type="text" class="slds-input" value="<?php if($product->getDescription() != null) echo $product->getDescription(); ?>" disabled />
                            </div>
                        </div>
                    </div>

                    <input id="productId" name="productId" type="hidden" class="slds-input" value="<?php if($product->getId() != null) echo $product->getId(); ?>" />
                    <input id="action" name="action" type="hidden" class="slds-input" value="<?php echo $action; ?>" />
                           
                    <div class="button-action" role="group">
                        <button class="slds-button slds-button_neutral" type="button" onclick="handleStockCleanFields()">limpar</button>
                        <a href="home.php" class="slds-button slds-button_neutral">Cancelar</a>
                        <button id="priceSave" class="slds-button slds-button_brand" type="submit" onclick="handleStockSubmit('save')">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <h2 id="element-with-table-label" class="slds-text-heading_medium slds-m-bottom_xx-small">Produtos em estoque</h2>
            <table class="slds-table slds-table_cell-buffer slds-table_bordered"
                aria-labelledby="element-with-table-label other-element-with-table-label">
                <thead>
                    <tr class="slds-line-height_reset">
                        <th class="" scope="col">
                            <div class="slds-truncate">ID</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">Produto</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">Quantidade</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">Data de entrada</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">Data de saída</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">ação</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php

                        foreach($stocks as $stock) { 
                            echo '<tr class="slds-hint-parent">';
                            echo '<td scope="row"><div class="slds-truncate">'. $stock->getId() .'</div></td>';
                            echo '<td scope="row"><div class="slds-truncate">'. $stock->getProductDescription() .'</div></td>';
                            echo '<td scope="row"><div class="slds-truncate">'. $stock->getQuantity() .'</div></td>';
                            echo '<td scope="row"><div class="slds-truncate">'. date("d/m/Y", strtotime($stock->getEntryDate())) .'</div></td>';
                            $departureDate = ($stock->getDepartureDate() != '') ? date("d/m/Y", strtotime($stock->getDepartureDate())) : '';
                            echo '<td scope="row"><div class="slds-truncate">'. $departureDate .'</div></td>';
                            echo '<td><div class="slds-truncate"><a href="#">Excluir</a></div></td>';
                            echo '</tr>';
                        }
                        ?>
    
                </tbody>
            </table>
        </div>
    </article>
</body>

</html>