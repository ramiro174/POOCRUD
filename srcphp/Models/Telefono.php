<?php

namespace proyecto\Models;


use PDO;
use proyecto\Auth;
use function json_encode;

class Telefono extends Models
{

 public $id;
 public $numero;
 public $usuarios_id;

    protected  $table = "telefonos";
    /**
     * @var array
     */
    protected $filleable = [
        "numero","usuarios_id"
    ];

}
