<?php

    include('../controller/registerController.php');

    $registerController = new RegisterController(null);
    $registers = $registerController->findAll();
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
                            <span>Caixas</span>
                        </a>
                    </h2>
                </div>
            </header>
        </div>
        <div class="card-body">
            <h2 id="element-with-table-label" class="slds-text-heading_medium slds-m-bottom_xx-small">Lista de caixas</h2>
            <table class="slds-table slds-table_cell-buffer slds-table_bordered"
                aria-labelledby="element-with-table-label other-element-with-table-label">
                <thead>
                    <tr class="slds-line-height_reset">
                        <th class="" scope="col">
                            <div class="slds-truncate">ID</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">data de abertura</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">data de fechamento</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">faturamento total</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">status</div>
                        </th>
                        <th class="" scope="col">
                            <div class="slds-truncate">ação</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    
                        <?php

                        foreach($registers as $register) { 
                            echo '<tr class="slds-hint-parent">';
                            echo '<td scope="row"><div class="slds-truncate">'. $register->getId() .'</div></td>';
                            echo '<td scope="row"><div class="slds-truncate">'. date("d/m/Y", strtotime($register->getOpenDate())) .'</div></td>';

                            if( !$register->getcloseDate()) echo '<td scope="row"><div class="slds-truncate"> - </div></td>';
                            else echo '<td scope="row"><div class="slds-truncate">'. date("d/m/Y", strtotime($register->getcloseDate())) .'</div></td>';
                            echo '<td scope="row"><div class="slds-truncate">'. $register->getTotalPayments() .'</div></td>';

                            if( $register->getStatus() == "open"){
                                echo '<td scope="row"><div class="slds-truncate">Aberto</div></td>';    
                            } else {
                                echo '<td scope="row"><div class="slds-truncate">Fechado</div></td>';
                            }


                            if( $register->getStatus() == "open"){
                                echo '<td scope="row"><div class="slds-truncate"><a href="home.php?content=registerResume.php&id='. $register->getId() .'" class="slds-button slds-button_brand">Fechar caixa</a></div></td>';    
                            } 
                            echo '</tr>';
                        }
                        ?>
    
                </tbody>
            </table>
        </div>
    </article>
</body>

</html>