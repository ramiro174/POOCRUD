<?php
    
    namespace proyecto;
 

    use PDO;
    use function json_encode;

    /**
     * Class Persona
     */
    
    class User extends Models
    {
        /**
         * @var array
         */
        protected $filleable = [
            "user",
            "contrasena",
            "nombre"
            ];
        protected $table = "usuarios";
        public $user="";
        public $contrasena="";
        public $nombre="";
        
        
    
    
        public function login($user,$contrasena){
            $respuesta=[];
            $stmt = self::$pdo->prepare("select *  from $this->table  where  user =:user  and contrasena=:contrasena");
            $stmt->bindParam(":user",$user);
            $stmt->bindParam(":contrasena",$contrasena);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            
            if($resultados){
                $respuesta["acceso"]=true;
                $respuesta["usuario"]=$resultados[0];
                $auth=new Auth();
                $auth->setUser($resultados[0]);
               return  json_encode($respuesta);
            }
            $respuesta["acceso"]=false;
            $respuesta["usuario"]=[];
            return  json_encode($respuesta);
            
            
        }
    
        public function find_name($name){
        
            $stmt = self::$pdo->prepare("select *  from $this->table  where  nombre=:name");
            $stmt->bindParam(":name",$name);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            if($resultados==null){
                return  json_encode([]);
            }
            return  json_encode($resultados[0]);
        }
    }
