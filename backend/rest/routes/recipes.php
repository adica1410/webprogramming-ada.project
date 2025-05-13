<?php
require_once '../../services/RecipeService.php';
header('Content-Type: application/json');

$recipeService = new RecipeService();

try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $data = json_decode(file_get_contents("php://input"), true);
            $recipeService->create_recipe($data);
            echo json_encode(["message" => "Recipe created successfully"]);
            break;

        case 'GET':
            if (isset($_GET['id'])) {
                echo json_encode($recipeService->get_recipe_by_id($_GET['id']));
            } else {
                echo json_encode($recipeService->get_all_recipes());
            }
            break;

        case 'PUT':
            $data = json_decode(file_get_contents("php://input"), true);
            $recipeService->update_recipe($data['id'], $data);
            echo json_encode(["message" => "Recipe updated successfully"]);
            break;

        case 'DELETE':
            $data = json_decode(file_get_contents("php://input"), true);
            $recipeService->delete_recipe($data['id']);
            echo json_encode(["message" => "Recipe deleted successfully"]);
            break;
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["error" => $e->getMessage()]);
}

Flight::route('GET /recipes', function () {
    Flight::json(Flight::get('recipe_service')->get_all_recipes());
});

Flight::route('GET /recipes/@id', function ($id) {
    Flight::json(Flight::get('recipe_service')->get_recipe_by_id($id));
});

Flight::route('POST /recipes', function () {
    $data = Flight::request()->data->getData();
    Flight::get('recipe_service')->create_recipe($data);
    Flight::json(["message" => "Recipe created successfully"]);
});

Flight::route('PUT /recipes/@id', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::get('recipe_service')->update_recipe($id, $data);
    Flight::json(["message" => "Recipe updated successfully"]);
});

Flight::route('DELETE /recipes/@id', function ($id) {
    Flight::get('recipe_service')->delete_recipe($id);
    Flight::json(["message" => "Recipe deleted successfully"]);
});

?>
