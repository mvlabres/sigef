<?php

if( $_SERVER['REQUEST_METHOD'] =='POST' ){
    $request = md5( implode( $_POST ) );
    
    if( isset( $_SESSION['last_request'] ) && $_SESSION['last_request']== $request ){
        echo 'refresh';
    }
    else{
        $_SESSION['last_request'] = $request;

    }
}

function sec_session_start() {
    error_reporting(0);
    date_default_timezone_set("America/Sao_Paulo");
    $session_name = 'logado'; 
    $secure=false;
    $httponly = true;

    if (!ini_set('session.use_only_cookies', 1)) {
        header('Location: ../index.php');
        exit();
    }
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    
    session_name($session_name);
    session_start();            

    session_regenerate_id();    
    
}


function login($email, $passwordToLogin, $mysqli) {
    
    $data = date('d/m/Y');
    $hora = date('h:i');

    if ($stmt = $mysqli->prepare("SELECT User.id, name, password ,ruleId, email, Rule.description 
                                  FROM User 
                                  INNER JOIN Rule 
                                  ON Rule.id = ruleId 
                                  WHERE email = ? 
                                  LIMIT 1")){ 
        
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($id, $name, $password, $ruleId, $email, $ruleDescription);
        $stmt->fetch();

        if ($stmt->num_rows != 1) return false;
        
        if ($passwordToLogin == $password){ 
            
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $password;
            $_SESSION['ruleId'] = $ruleId;
            $_SESSION['email'] = $email;
            $_SESSION['ruleDescription'] = $ruleDescription;
            return true;
        } 
        
        return false;    
    }
}

sec_session_start();

function login_check($mysqli) {
    if (!isset($_SESSION['email'])) return false;

    $email = $_SESSION['email'];

    if ($stmt = $mysqli->prepare("SELECT User.id, name, password ,ruleId, email, Rule.description 
                                  FROM User 
                                  INNER JOIN Rule 
                                  ON Rule.id = ruleId 
                                  WHERE email = ? 
                                  LIMIT 1")){
                                      
        $stmt->bind_param('i', $id);
        $stmt->execute();  
        $stmt->store_result();

        if($stmt->num_rows != 1) return false;

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 7200)){
                session_unset();     
                session_destroy();  
                return false;
        }else{
            $_SESSION['LAST_ACTIVITY'] = time();
            return true;
        }
    }
}