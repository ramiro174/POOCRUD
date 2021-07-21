<?php
    
    namespace proyecto;
 



    /**
     * Class Persona
     */
    
    class Ciudad extends Models
    {
        /**
         * @var array
         */
        protected $filleable = ["nombre"];
        protected $table = "ciudades";
       
        public $nombre= "";
       
        
        
    }
