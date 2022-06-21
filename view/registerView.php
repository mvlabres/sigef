<?php

    include('../controller/registerController.php');

    $registerController = new RegisterController(null);

    if(isset($_GET['id'])){

        $id = $_GET['id'];
        $registers = $registerController->close($id);
    }

?>