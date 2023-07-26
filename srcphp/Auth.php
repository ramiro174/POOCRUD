<?php

namespace proyecto;

use Carbon\Carbon;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use proyecto\Models\User;

class Auth
{
    private $user;

    public static function generateToken($data, $time = 3600): string
    {
        $t = Carbon::now()->timestamp + $time;
        $key = 'orimar174';
        $payload = ['exp' => $t, 'data' => $data];
        return JWT::encode($payload, $key, 'HS256');
    }

    /**
     * @return mixed
     */
    public static function getUser()
    {
        $secretKey = 'orimar174';
        $jwt = Router::getBearerToken();
        $token = JWT::decode($jwt, new key($secretKey, 'HS256'));
        return User::find($token->data[0]);
    }

    /**
     * @param mixed $user
     */
    public static function setUser($user): void
    {
        $session = new Session();
        $session->set('user', $user);

    }

    public function clearUser($user): void
    {
        $se = new Session();
        $se->remove("user");
    }


}
