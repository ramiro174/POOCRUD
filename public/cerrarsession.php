<?php
    
    namespace proyecto;
    
    use Exception;
    try {
        require("../vendor/autoload.php");
        $se=new Auth();
        $se->clearUser();
        header("Location: login.html");
        exit();
    } catch (Exception $e) {
        echo($e->getMessage());
    }







