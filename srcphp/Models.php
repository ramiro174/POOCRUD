<?php
    
    namespace proyecto;
    
   
    use proyecto\Conexion;
    
    class Models
    {
        /**
         * Models constructor.
         */
        protected $filleable = [];
        public static $pdo = null;
        protected $table = "";
        public function __construct()
        {
            $cc = new  Conexion("ramiro_db", "localhost", "ramiro_ramiror ", "orimar174");
            self::$pdo = $cc->getPDO();
        }
        public function create(array $obj)
        {
            $campos = "(";
            $valores = "(";
            $long = count($obj);
            $i = 0;
            foreach ($obj as $prop => $val) {
                $i++;
                $campos .= $prop;
                $campos .= $long > $i ? "," : "";
                $valores .= ":" . $prop;
                $valores .= $long > $i ? "," : "";
            }
            $campos .= " )";
            $valores .= " )";
            $stmt = self::$pdo->prepare("INSERT INTO $this->table   $campos VALUES  $valores");
            
            foreach ($obj as $prop => $val) {
                $stmt->bindValue(":$prop", $val);
            }
            $stmt->execute();
        }
        public function save()
        {
            $ob = [];
            foreach ($this->filleable as $campo) {
                $ob[$campo] = $this->$campo;;
            }
            $this->create($ob);
        }
        
    }
