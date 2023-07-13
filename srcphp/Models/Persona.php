<?php

    namespace proyecto\Models;


    use PDO;
    use function json_encode;

    /**
     * Class Persona
     */

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


        public function PersonaMayores($edad){

            $stmt = self::$pdo->prepare("select *  from $this->table  where  edad>=:edad");
            $stmt->bindParam(":edad",$edad);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            return  json_encode($resultados);
        }


    }
