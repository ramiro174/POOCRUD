<?php
    
    namespace proyecto;
    
   
    use PDO;
    use proyecto\Conexion;
    use function json_encode;

    class Models
    {
        /**
         * Models constructor.
         */
        protected $filleable = [];
        public static $pdo = null;
        protected $table = "";
        protected  $id="";
        
        public function __construct()
        {
            $cc = new  Conexion("agenda", "localhost", "ramiro", "orimar174");
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
               
                $ob[$campo] = $this->$campo;
            
            }
            $this->create($ob);
        }
        public function all(){
          
          
            $stmt = self::$pdo->prepare("select * from $this->table");

            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);


            return  json_encode($resultados);
        }
        
        
        public function delete($id){
            
            try{
                $cid= $this->id!=""?$this->id:"id";
                $stmt = self::$pdo->prepare("delete from $this->table where $cid=:id");
                $stmt->bindParam(":id",$id);
                $stmt->execute();
                }
            catch (Exception $e) {
                return $e;
            }
        }
        public function deleteAll(){
            $stmt = self::$pdo->prepare("delete  from $this->table ");
            $stmt->execute();
        }
        public function find($id){
            $cid= $this->id!=""?$this->id:"id";
            $stmt = self::$pdo->prepare("select *  from $this->table  where  $cid=:id");
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            if($resultados==null){
                return  json_encode([]);
            }
            return  json_encode($resultados[0]);
        }
       
        
    }
