<?php
    
    namespace proyecto;
    
    use Exception;
    
    error_reporting(E_ALL);
    error_reporting(-1);
    ini_set('error_reporting', E_ALL);
    require("../vendor/autoload.php");
    try {
        $p = new Persona();
        $p->nombre = "Juanitos";
        $p->edad = "22";
        $p->apellido_paterno = "Esquivel";
        $p->apellido_materno = "Duran";
        $p->save();
        print_r($p);
    } catch (Exception $e) {
        return $e->getMessage();
    }
    
    
    
    
   
    
