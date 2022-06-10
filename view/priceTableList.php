<?php

    /* include('../controller/productController.php');

    $productController = new ProductController(null);
    $products = $productController->findAll();*/

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
                            <span>Tabelas de preço</span>
                        </a>
                    </h2>
                </div>
                <div class="slds-no-flex">
                    <a href="home.php?content=priceTableView.php" class="slds-button slds-button_neutral">Novo</a>
                </div>
            </header>
        </div>
        <div class="card-body">
            <h2 id="element-with-table-label" class="slds-text-heading_medium slds-m-bottom_xx-small">Lista de tabela de preços</h2>
            <table class="slds-table slds-table_cell-buffer slds-table_bordered"
                aria-labelledby="element-with-table-label other-element-with-table-label">
                <thead>
                    <tr class="slds-line-height_reset">
                        <th class="" scope="col">
                            <div class="slds-truncate">ID</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">Preço de custo</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">Custo unt.</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">Custo variável</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">Custo fixo</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">Custo total</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">Preço final</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">markup</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">ação</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                        <!-- <?php

                        foreach($productsType as $productType) { 
                            echo '<tr class="slds-hint-parent">';
                            echo '<td scope="row"><div class="slds-truncate">'. $productType->getId() .'</div></td>';
                            echo '<td scope="row"><div class="slds-truncate">'. $productType->getDescription() .'</div></td>';
                            echo '<td><div class="slds-truncate"><a href="#">Excluir</a></div></td>';
                            echo '</tr>';
                        }
                        ?> -->
    
                </tbody>
            </table>
        </div>
    </article>
</body>

</html>