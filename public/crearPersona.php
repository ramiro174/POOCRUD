<?php
    
    namespace proyecto;

    
   
    use Exception;

   try{
  require("../vendor/autoload.php");
  
//
        $p = new Persona();
        $p->nombre = "Juanitos2";
        $p->edad = "22";
        $p->apellido_paterno = "Esquivel";
        $p->apellido_materno = "Duran";
        $p->save();
      echo($p->nombre);
//
//
    } catch (Exception $e) {
        return $e->getMessage();
    }
//






