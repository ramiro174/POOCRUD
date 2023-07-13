<?php

namespace proyecto\Controller;

use Exception;

use proyecto\Models\User;
use proyecto\Response\Success;
class crearPersonaController

{

    function crearPersona()
    {
      $user= new User();
        $user->nombre="juan";
        $user->edad=20;
        $user->correo="r@gmail.com";
        $user->contrasena="123";
        $user->user="juan";
        $user->save();
      $r= new Success($user);
        return $r->Send();

    }
    function response()
    {
        $r= new Success("hola");
        return $r->Send();
    }

    function prueba(){
        echo "prueba";
    }
}






