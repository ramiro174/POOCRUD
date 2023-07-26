<?php

namespace proyecto;

use DateTimeImmutable;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\key;
use proyecto\Response\Failure;

class Router
{
    public static function get($route, $path_to_include)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            Router::route($route, $path_to_include);
        }
    }

    public static function route($route, $path_to_include)
    {
        Router::headers();
        $callback = $path_to_include;
        if (!is_callable($callback) && !is_array($callback)) {
            if (!strpos($path_to_include, '.php')) {
                $path_to_include .= '.php';
            }
        }
        if ($route == "/404") {
            include_once __DIR__ . "/$path_to_include";
            exit();
        }
        $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
        $request_url = rtrim($request_url, '/');
        $request_url = strtok($request_url, '?');
        $route_parts = explode('/', $route);
        $request_url_parts = explode('/', $request_url);
        array_shift($route_parts);
        array_shift($request_url_parts);
        if ($route_parts[0] == '' && count($request_url_parts) == 0) {
            // Callback function
            if (is_callable($callback)) {
                call_user_func_array($callback, []);
                exit();
            }
            include_once __DIR__ . "/$path_to_include";
            exit();
        }
        if (count($route_parts) != count($request_url_parts)) {
            return;
        }
        $parameters = [];
        for ($__i__ = 0; $__i__ < count($route_parts); $__i__++) {
            $route_part = $route_parts[$__i__];
            if (preg_match("/^[$]/", $route_part)) {
                $route_part = ltrim($route_part, '$');
                array_push($parameters, $request_url_parts[$__i__]);
                $$route_part = $request_url_parts[$__i__];
            } else if ($route_parts[$__i__] != $request_url_parts[$__i__]) {
                return;
            }
        }
        if (is_array($callback)) {
            try {
                $i = new $callback[0]();
                call_user_func_array([$i, $callback[1]], $parameters);
                exit();
            } catch (\Exception $e) {

                echo json_encode([
                    "error" => $e->getMessage()
                ]);
                exit();
            }


        }

        // Callback function
        if (is_callable($callback)) {
            call_user_func_array($callback, $parameters);
            exit();
        }
        include_once __DIR__ . "/$path_to_include";
        exit();
    }

    public static function headers()
    {

        header('Content-Type: application/json');   // MIME type for a json response
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Authorization, Content-Type');
        header('Access-Control-Allow-Credentials: true');


    }

    public static function post($route, $path_to_include, $valid_token = false)
    {
        if ($valid_token) {
            self::is_token_valid();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            Router::route($route, $path_to_include);
        }
    }

    public static function is_token_valid()
    {
        $secretKey = 'orimar174';
        $jwt = self::getBearerToken();
        try {
            $token = JWT::decode($jwt, new key($secretKey, 'HS256'));
            $now = new DateTimeImmutable();
            if ($token->exp < $now->getTimestamp()) {
              header('HTTP/1.1 401 Unauthorized');
                return false;
                exit;
            }
            return true;
        } catch (ExpiredException $e) {
            if ($e->getMessage() == "Expired token") {
                list($header, $payload, $signature) = explode(".", $jwt);
//                $payload = json_decode(base64_decode($payload));
//                $refresh_token = $payload->data->refresh_token;
                header('HTTP/1.1 401 Unauthorized');
                $r = new Failure(401, "Token expirado");

                return $r->Send();

            }
        }
    }

    public static function getBearerToken()
    {
        $headers = self::getTokenRequest();
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    public static function getTokenRequest()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    public static function put($route, $path_to_include)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            Router::route($route, $path_to_include);
        }
    }

    public static function patch($route, $path_to_include)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
            Router::route($route, $path_to_include);
        }
    }

    public static function delete($route, $path_to_include)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            Router::route($route, $path_to_include);
        }
    }

    public static function any($route, $path_to_include)
    {
        Router::route($route, $path_to_include);
    }

    public static function out($text)
    {
        echo htmlspecialchars($text);
    }

    public static function set_csrf()
    {
        session_start();
        if (!isset($_SESSION["csrf"])) {
            $_SESSION["csrf"] = bin2hex(random_bytes(50));
        }
        echo '<input type="hidden" name="csrf" value="' . $_SESSION["csrf"] . '">';
    }

    public static function is_csrf_valid()
    {
        session_start();
        if (!isset($_SESSION['csrf']) || !isset($_POST['csrf'])) {
            return false;
        }
        if ($_SESSION['csrf'] != $_POST['csrf']) {
            return false;
        }
        return true;
    }


}
