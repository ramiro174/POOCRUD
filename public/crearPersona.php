<?php
    
    namespace proyecto;
    
    use Exception;
    use function print_r;
    error_reporting(E_ALL);
    ini_set('error_reporting', E_ALL);
    try{
    require("../vendor/autoload.php");
   
        $p = new Persona();
        $p->nombre = "Juanitos";
        $p->edad = "22";
        $p->apellido_paterno = "Esquivel";
        $p->apellido_materno = "Duran";
        $p->save();
      print_r($p);
      echo "sss";
      
    } catch (Exception $e) {
        return $e->getMessage();
    }
    
    
    
    
   
    
