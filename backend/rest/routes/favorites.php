<?php
require_once '../../dao/FavoriteDao.php';
header('Content-Type: application/json');

$favoriteDao = new FavoriteDao();

// CREATE (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $favoriteDao->addFavorite($data['user_id'], $data['recipe_id']);
    echo json_encode(["message" => "Added to favorites"]);
}

// READ (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['user_id'])) {
        echo json_encode($favoriteDao->getUserFavorites($_GET['user_id']));
    }
}

// DELETE (DELETE)
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    $favoriteDao->removeFavorite($data['user_id'], $data['recipe_id']);
    echo json_encode(["message" => "Removed from favorites"]);
}
?>
