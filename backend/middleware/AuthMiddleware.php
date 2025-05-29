<?php
require_once __DIR__ . '/../config/JwtHelper.php';

Flight::map('auth_required', function () {
    $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
    if (!$authHeader) {
        Flight::halt(401, json_encode(["error" => "Authorization header missing"]));
    }

    $token = str_starts_with($authHeader, 'Bearer ') ? substr($authHeader, 7) : $authHeader;

    try {
        $decoded = JwtHelper::decode($token);
        Flight::set('user', (object) $decoded); // cast kao objekt da bude $user->id, $user->role
    } catch (Exception $e) {
        Flight::halt(401, json_encode(["error" => "Invalid token: " . $e->getMessage()]));
    }
});
