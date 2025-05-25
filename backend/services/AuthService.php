<?php
require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/../config/JwtHelper.php';

class AuthService {
    private $userDao;

    public function __construct() {
        $this->userDao = new UserDao();
    }

    public function register($data) {
        if (empty($data['email']) || empty($data['password']) || empty($data['name'])) {
            throw new Exception("Missing required fields.");
        }

        $existing = $this->userDao->getUserByEmail($data['email']);
        if ($existing) throw new Exception("User already exists.");

        $hashed = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->userDao->createUser($data['name'], $data['email'], $hashed, 'user');

        return ["message" => "Registration successful"];
    }

    public function login($data) {
        $user = $this->userDao->getUserByEmail($data['email']);
        if (!$user || !password_verify($data['password'], $user['password'])) {
            throw new Exception("Invalid credentials");
        }

        $payload = [
            "id" => $user['id'],
            "email" => $user['email'],
            "role" => $user['role']
        ];

        return [
            "token" => JwtHelper::encode($payload),
            "id" => $user['id'],
            "name" => $user['name'],      //  Dodano ime
            "role" => $user['role']       //  Dodana rola
        ];
        
    }
}
