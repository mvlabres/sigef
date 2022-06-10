<?php

    include_once '../controller/connection.php';
    include_once '../controller/session.php';

    date_default_timezone_set("America/Sao_Paulo");
    $messageLoginFail;

    if (isset($_SESSION['username'])) {
        echo "<script>window.location='home.php'</script>";
    }

    if(isset($_GET['loginFail'])) {
    
        $messageLoginFail = 'Email ou senha estão incorretos!';
    }

?>
<!doctype html>
<html>

<head>
    <link rel="stylesheet" href="node_modules/@salesforce-ux/design-system/assets/styles/salesforce-lightning-design-system.min.css" />
    <link rel="stylesheet" href="custom-css/style.css" />    
</head>

<body class="body-center">
    <div class="login-card">
        <article class="slds-card">
            <div class="slds-card__header slds-grid">
                <form role="form" action="../controller/loginCheck.php" method="post">
                    <header class="slds-media slds-media_center slds-has-flexi-truncate">
                        <div class="card-body">
                            <div class="form-image">
                                <img src="img/logos/logo.png">
                            </div>
                            <div class="full-center">
                                <?php echo '<div class="slds-text-color_destructive slds-text-heading_medium">' . $messageLoginFail . '</div>'; ?>
                            </div>
                            <div class="slds-form-element">
                                <label class="slds-form-element__label" for="text-input-id-46">Email</label>
                                <div class="slds-form-element__control">
                                    <input type="text" name="email" id="text-input-id-46" class="slds-input" />
                                </div>
                            </div>
                            <div class="slds-form-element">
                                <label class="slds-form-element__label" for="text-input-id-46">Senha</label>
                                <div class="slds-form-element__control">
                                    <input type="password" name="password" id="text-input-id-46" class="slds-input" />
                                </div>
                            </div>
                            <div class="button-form">
                                <button type="submit" class="slds-button slds-button_brand">Entrar</button>
                            </div>
                            <div class="form-link">
                                <a href="#" class="slds-text-link">Esqueceu a senha?</a>
                            </div>
                        </div>
                    </header>
                </form>
            </div>
        </article>
    </div>
</body>

</html>