<?php
header('Content-Type: text/html; charset=utf-8');

class Connection{

    public $mySqli;

    public function __construct(){

        $credentials = array(
            'server' => 'localhost',  
            'user' => 'root',   
            'password' => '',       
            'db' => 'patylook'  
        );

        // to production
        /*$credentials = array(
            'server' => '',  
            'user' => '',   
            'password' => '',       
            'db' => ''  
        );*/
        
        $this->mySqli = new MySQLi($credentials['server'], $credentials['user'], $credentials['password'], $credentials['db']);
        $this->mySqli->set_charset("utf8");
    }

    function connect(){
        return $this->mySqli;
    }
}

?>