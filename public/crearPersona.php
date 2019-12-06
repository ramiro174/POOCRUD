<?php
    
    namespace proyecto;
    
    use Exception;

   try{
  require("../vendor/autoload.php");
  
       $p = new Persona();
//        $p->nombre = "Ramiro22";
//        $p->edad = "22";
//        $p->apellido_paterno = "Esquivel";
//        $p->apellido_materno = "Duran";
//        $p->save();
//
        $c=new Ciudad();
        $c->nombre="Nuevo Casas Grandes";
        $c->estado="Chihuahua";
        $c->save();

//      echo($p->nombre);
//      echo $c->nombre;
//
//
    echo $p->PersonaMayores(20);
    
    
    
    } catch (Exception $e) {
           echo($e->getMessage());
    }
//






