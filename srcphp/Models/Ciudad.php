<?php

namespace proyecto\Models;


/**
 * Class Persona
 */
class Ciudad extends Models
{
    public $nombre = "";
    /**
     * @var array
     */
    protected $filleable = ["nombre"];
    protected $table = "ciudades";


}
