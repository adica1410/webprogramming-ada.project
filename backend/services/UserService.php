<?php
require_once __DIR__ . '/../dao/UserDao.php';
require_once __DIR__ . '/BaseService.php';

class UserService extends BaseService{
    private $userDao;

    public function __construct() {
        $this->userDao = new UserDao();
    }

    public function get_all_users() {
        return $this->userDao->getAllUsers();
    }

    public function get_user_by_id($id) {
        if (!is_numeric($id)) {
            throw new Exception("Invalid user ID.");
        }
        return $this->userDao->getUserById($id);
    }

    public function create_user($data) {
        $required = ['name', 'email', 'password'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                throw new Exception("Missing field: $field");
            }
        }

        // Basic email validation
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        $role = 'user';
if (isset($data['role']) && $data['role'] === 'admin') {
    throw new Exception("You cannot assign yourself admin privileges.");
}

return $this->userDao->createUser(
    $data['name'],
    $data['email'],
    $data['password'],
    $role
);
    }

    public function update_user($id, $data) {
        if (!is_numeric($id)) {
            throw new Exception("Invalid user ID.");
        }

        if (empty($data['name']) || empty($data['email'])) {
            throw new Exception("Name and email are required.");
        }

        return $this->userDao->updateUser($id, $data['name'], $data['email']);
    }

    public function delete_user($id) {
        if (!is_numeric($id)) {
            throw new Exception("Invalid user ID.");
        }
        return $this->userDao->deleteUser($id);
    }
}
