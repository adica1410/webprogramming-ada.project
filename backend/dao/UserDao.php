<?php
require_once 'BaseDao.php';

class UserDao extends BaseDao {
    public function getAllUsers() {
        return $this->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        return $this->query("SELECT * FROM users WHERE id = ?", [$id])->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($name, $email, $password, $role = "user") {
        return $this->query("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)", 
            [$name, $email, password_hash($password, PASSWORD_BCRYPT), $role]);
    }

    public function updateUser($id, $name, $email) {
        return $this->query("UPDATE users SET name = ?, email = ? WHERE id = ?", [$name, $email, $id]);
    }

    public function deleteUser($id) {
        return $this->query("DELETE FROM users WHERE id = ?", [$id]);
    }
}
?>
