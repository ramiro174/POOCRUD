<?php

namespace proyecto\Controller;

use proyecto\Models\Table;
use proyecto\Models\Telefono;
use proyecto\Response\Failure;
use proyecto\Response\Success;

class AgendaController
{
   function registrarTelefono(){
         $t=new Telefono();
         $t->numero="123456789";
            $t->usuarios_id=12;
            $t->save();
            $r= new Success($t);
            return $r->Send();
    }
    function buscartelefono($id){
        $t=Telefono::find($id);
        if($t){
            $r= new Success($t);
            return $r->Send();
        }else
        {
            $r=new Failure(404,"No se encontro el telefono");
            return $r->Send();
        }
    }

    function mostrartelefonos(){
//        $t=Telefono::where("usuarios_id","=",12);
//        $r= new Success($t);
//        return $r->Send();

        $t=Table::query("select * from telefonos where usuarios_id=12");
        $r= new Success($t);
        return $r->Send();

    }
}
