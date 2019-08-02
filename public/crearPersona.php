<?php
    
    namespace proyecto;
    use Exception;

    require("../vendor/autoload.php");
    try{
    
        $p = new Persona();
        $p->nombre = "Ramiro";
        $p->edad = "22";
        $p->apellido_paterno = "Esquivel";
        $p->apellido_materno = "Duran";
        $p->save();
    
    }catch (Exception $e){
            return $e->getMessage();
    }
    
    
    
    
   
    
