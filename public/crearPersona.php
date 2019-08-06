<?php
    
    namespace proyecto;

    
   
    use Exception;

   try{
  require("../srcphp/Persona.php");
  
//
        $p = new Persona();
        $p->nombre = "Juanitos";
//        $p->edad = "22";
//        $p->apellido_paterno = "Esquivel";
//        $p->apellido_materno = "Duran";
//        $p->save();
      echo($p->nombre);
//
//
    } catch (Exception $e) {
          echo ($e->getMessage());
    }
//






