<?php
    
    namespace proyecto;
    
    use Exception;
    
    try {
        require("../vendor/autoload.php");
         extract($_POST);
       
        $u = new  User();
        echo ($u->login($usuario,$contrasena));

    } catch (Exception $e) {
        echo($e->getMessage());
    }
    //






