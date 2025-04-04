<?php
require_once '../../dao/UserDao.php';
header('Content-Type: application/json');

$userDao = new UserDao();

// CREATE (POST) - Dodavanje korisnika
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $userDao->createUser($data['name'], $data['email'], $data['password'], $data['role']);
    echo json_encode(["message" => "User created successfully"]);
}

// READ (GET) - Dohvaćanje korisnika
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        echo json_encode($userDao->getUserById($_GET['id']));
    } else {
        echo json_encode($userDao->getAllUsers());
    }
}

// UPDATE (PUT) - Ažuriranje korisnika
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    $userDao->updateUser($data['id'], $data['name'], $data['email'], $data['role']);
    echo json_encode(["message" => "User updated successfully"]);
}

// DELETE (DELETE) - Brisanje korisnika
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    $userDao->deleteUser($data['id']);
    echo json_encode(["message" => "User deleted successfully"]);
}
?>
