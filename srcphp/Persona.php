<?php
    
    namespace proyecto;
 

    /**
     * Class Persona
     */
    require ("../srcphp/Models.php");
    class Persona extends Models
    {
        /**
         * @var array
         */
        protected $filleable = ["nombre", "edad", "apellido_paterno", "apellido_materno"];
        protected $table = "personas";
        public $nombre = "";
        public $edad = "";
        public $apellido_paterno = "";
        public $apellido_materno = "";
        
    }
