<?php

require('connection.php');
require('session.php');

$email =  $_POST['email'];
$password =  $_POST['password'];
$connection = new Connection();

if (!login($email, $password, $connection->mySqli)) echo "<script>window.location='../view/login.php?loginFail'</script>";

echo "<script>window.location='../view/home.php'</script>";	

?>