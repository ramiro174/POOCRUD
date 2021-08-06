<?php
    
    namespace proyecto;
    
    use Exception;
    

   try{
//        require("../vendor/autoload.php");
  
      //echo json_encode ($_POST);
      return  extract($_POST);
//       echo $nombre;
       
      
       $c=new Ciudad();
//       $c->nombre=$nombre;
//       $c->save();
      
      
      echo  json_encode( $c->all());
   
      
      
      
//        $p = new Persona();
//        $p->nombre = "Ramiro22";
//        $p->edad = "22";
//        $p->apellido_paterno = "Esquivel";
//        $p->apellido_materno = "Duran";
//        $p->save();
//


//      echo($p->nombre);
//      echo $c->nombre;
//
//
    //echo $p->PersonaMayores(20);
    
    
    
    } catch (Exception $e) {
           echo($e->getMessage());
    }
//






