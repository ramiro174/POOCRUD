<?php

    namespace proyecto\Models;


    use PDO;
    use proyecto\Conexion;
    use proyecto\Exception;
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
            $cc = new  Conexion("web", "localhost", "root", "");
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
            if($stmt->execute()){
                return $this->id=(self::$pdo->lastInsertId());
            };
        }
        public function save()
        {
            $ob = [];
            foreach ($this->filleable as $campo) {

                $ob[$campo] = $this->$campo;

            }
            $this->create($ob);
        }
        public static function all(){
            $class = get_called_class();
            $c = new $class();

            $stmt = self::$pdo->prepare("select * from  $c->table");

            $stmt->execute();

            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);

            return  $resultados;
        }
        public static function delete($id){
            $class = get_called_class();
            $c = new $class();
            try{
                $cid=   $c->id!=""?  $c->id:"id";
                $stmt = self::$pdo->prepare("delete from   $c->table where $cid=:id");
                $stmt->bindParam(":id",$id);
                $stmt->execute();
                }
            catch (Exception $e) {
                return $e;
            }
        }
        public static function deleteby($field,$condition,$value){
            $class = get_called_class();
            $c = new $class();
            try{
                $cid=   $c->id!=""?  $c->id:"id";
                $stmt = self::$pdo->prepare("delete from   $c->table where $field $condition :value");
                $stmt->bindParam(":value",$value);
                $stmt->execute();
                }
            catch (Exception $e) {
                return $e;
            }
        }
        public static function deleteAll(){
            $class = get_called_class();
            $c = new $class();

            $stmt = self::$pdo->prepare("delete  from $c->table ");
            $stmt->execute();
        }
        public  static function find($id){
            $class = get_called_class();
            $c = new $class();
            $cid= $c->id!=""?$c->id:"id";
            $stmt = self::$pdo->prepare("select *  from $c->table  where  $cid=:id");
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_CLASS, get_called_class());
            if($resultados==null){
                return  null;
            }

            return  $resultados[0];
        }
        public  static function where($field,$condition,$value){
            $class = get_called_class();
            $c = new $class();
            $stmt = self::$pdo->prepare("select *  from $c->table  where  $field $condition :value");
            $stmt->bindParam(":value",$value);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_CLASS, get_called_class());
            if($resultados==null){
                return  null;
            }

            return  $resultados;
        }





    }
