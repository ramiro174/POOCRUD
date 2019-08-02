<?php
   
    namespace proyecto;
    use Exception;

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require("../vendor/autoload.php");
    try{
    
        $p = new Persona();
        $p->nombre = "Juanitos";
        $p->edad = "22";
        $p->apellido_paterno = "Esquivel";
        $p->apellido_materno = "Duran";
        $p->save();
    
    }catch (Exception $e){
            return $e->getMessage();
    }
    
    
    
    
   
    
