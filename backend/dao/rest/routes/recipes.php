<?php
require_once '../../dao/RecipeDao.php';
header('Content-Type: application/json');

$recipeDao = new RecipeDao();

// CREATE (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $recipeDao->createRecipe($data['name'], $data['description'], $data['ingredients'], $data['instructions'], $data['user_id'], $data['category_id']);
    echo json_encode(["message" => "Recipe created successfully"]);
}

// READ (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        echo json_encode($recipeDao->getRecipeById($_GET['id']));
    } else {
        echo json_encode($recipeDao->getAllRecipes());
    }
}

// UPDATE (PUT)
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    $recipeDao->updateRecipe($data['id'], $data['name'], $data['description'], $data['ingredients'], $data['instructions']);
    echo json_encode(["message" => "Recipe updated successfully"]);
}

// DELETE (DELETE)
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    $recipeDao->deleteRecipe($data['id']);
    echo json_encode(["message" => "Recipe deleted successfully"]);
}
?>
