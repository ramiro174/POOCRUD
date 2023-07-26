<?php

namespace proyecto\Models;


use PDO;
use proyecto\Auth;
use proyecto\Response\Failure;
use proyecto\Response\Response;
use proyecto\Response\Success;
use function json_encode;

class User extends Models
{

    public $user = "";
    public $contrasena = "";
    public $nombre = "";
    public $edad = "";
    public $correo = "";
    public $apellido = "";

    public $id = "";

    /**
     * @var array
     */
    protected $filleable = [
        "nombre",
        "edad",
        "correo",
        "apellido",
        "contrasena",
        "user"
    ];
    protected    $table = "usuarios";



    public static function auth($user, $contrasena):Response
    {
        $class = get_called_class();
        $c = new $class();
        $stmt = self::$pdo->prepare("select *  from $c->table  where  user =:user  and contrasena=:contrasena");
        $stmt->bindParam(":user", $user);
        $stmt->bindParam(":contrasena", $contrasena);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_CLASS,User::class);

        if ($resultados) {
//            Auth::setUser($resultados[0]);  pendiente
            $r=new Success(["usuario"=>$resultados[0],"_token"=>Auth::generateToken([$resultados[0]->id])]);
           return  $r->Send();
        }
        $r=new Failure(401,"Usuario o contraseña incorrectos");
        return $r->Send();

    }

    public function find_name($name)
    {
        $stmt = self::$pdo->prepare("select *  from $this->table  where  nombre=:name");
        $stmt->bindParam(":name", $name);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
        if ($resultados == null) {
            return json_encode([]);
        }
        return json_encode($resultados[0]);
    }

    public  function reportecitas(){
        $JSONData = file_get_contents("php://input");
        $dataObject = json_decode($JSONData);

        $name=$dataObject->name;
        $d=Table::query("select * from users  where name='".$name."'");
        $r=new Success($d);

    }

}
