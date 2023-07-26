<?php

namespace proyecto\Controller;

use proyecto\Auth;
use proyecto\Models\User;
use proyecto\Response\Failure;
use proyecto\Response\Success;

class UserController
{

    function auth()
    {
        try {
            $JSONData = file_get_contents("php://input");
            $dataObject = json_decode($JSONData);
            if (!property_exists($dataObject, "user") || !property_exists($dataObject, "contrasena")) {
                throw new \Exception("Faltan datos");
            }
            return User::auth($dataObject->user, $dataObject->contrasena);

        } catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }


    }


    function registro()
    {
        try {
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
        } catch (\Exception $e) {
            $r = new Failure(401, $e->getMessage());
            return $r->Send();
        }


    }

    function buscar()
    {
        $JSONData = file_get_contents("php://input");
        $dataObject = json_decode($JSONData);
        if (property_exists($dataObject->nombre)) {

            $alluser = User::where("nombre", "=", $dataObject->nombre);
            if ($alluser) {
                $r = new Success($alluser);
            }


        }


    }

    function listar()
    {
        $alluser = User::all();
        $r = new Success($alluser);
        return $r->Send();
    }


    function eliminarAllUsers()
    {
        User::deleteAll();
    }

    function eliminarUsersbyId($id)
    {
        User::delete($id);
    }
}
