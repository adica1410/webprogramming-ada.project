<?php
require_once '../../dao/CategoryDao.php';
header('Content-Type: application/json');

$categoryDao = new CategoryDao();

// CREATE (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $categoryDao->createCategory($data['name'], $data['description']);
    echo json_encode(["message" => "Category created successfully"]);
}

// READ (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        echo json_encode($categoryDao->getCategoryById($_GET['id']));
    } else {
        echo json_encode($categoryDao->getAllCategories());
    }
}

// UPDATE (PUT)
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    $categoryDao->updateCategory($data['id'], $data['name'], $data['description']);
    echo json_encode(["message" => "Category updated successfully"]);
}

// DELETE (DELETE)
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    $categoryDao->deleteCategory($data['id']);
    echo json_encode(["message" => "Category deleted successfully"]);
}
?>
