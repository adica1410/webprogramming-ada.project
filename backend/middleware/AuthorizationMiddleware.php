<?php

class AuthorizationMiddleware {
    public static function is_admin() {
        $user = Flight::get('user');
        if (!$user || $user->role !== 'admin') {
            Flight::halt(403, json_encode(['error' => 'Admin access only']));
        }
    }

    public static function is_user_or_admin() {
        $user = Flight::get('user');
        if (!$user || !in_array($user->role, ['admin', 'user'])) {
            Flight::halt(403, json_encode(['error' => 'Access denied']));
        }
    }

    public static function is_owner_or_admin($owner_id) {
        $user = Flight::get('user');
        if (!$user || ($user->role !== 'admin' && $user->id != $owner_id)) {
            Flight::halt(403, json_encode(['error' => 'Forbidden']));
        }
    }
}
