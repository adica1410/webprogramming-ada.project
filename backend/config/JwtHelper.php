<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHelper {
    private static $secret = "secret_key"; 

    public static function encode($data) {
        return JWT::encode($data, self::$secret, 'HS256');
    }

    public static function decode($token) {
        return JWT::decode($token, new Key(self::$secret, 'HS256'));
    }
}
