<?php

namespace proyecto\Controller;
use proyecto\Models\User;
use proyecto\Response\Failure;
use proyecto\Response\Success;

class UserController
{

    function registro()
    {
        try{
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
            $user = new User();
            $user->nombre = $dataObject->nombre;
            $user->apellido = $dataObject->apellido;
            $user->edad = $dataObject->edad;
            $user->correo = $dataObject->correo;
            $user->user = $dataObject->user;
            $user->contrasena = $dataObject->contrasena;
            $user->save();
            $r = new Success($user);
            return $r->Send();
        }catch (\Exception $e){
            $r = new Failure(401,$e->getMessage());
            return $r->Send();
        }



    }
}
