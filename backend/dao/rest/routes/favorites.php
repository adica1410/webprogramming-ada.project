<?php
require_once '../../services/FavoriteService.php';
header('Content-Type: application/json');

$favoriteService = new FavoriteService();

try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $data = json_decode(file_get_contents("php://input"), true);
            $favoriteService->add_to_favorites($data['user_id'], $data['recipe_id']);
            echo json_encode(["message" => "Added to favorites"]);
            break;

        case 'GET':
            if (isset($_GET['user_id'])) {
                echo json_encode($favoriteService->get_user_favorites($_GET['user_id']));
            } else {
                throw new Exception("Missing user_id in GET");
            }
            break;

        case 'DELETE':
            $data = json_decode(file_get_contents("php://input"), true);
            $favoriteService->remove_from_favorites($data['user_id'], $data['recipe_id']);
            echo json_encode(["message" => "Removed from favorites"]);
            break;
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["error" => $e->getMessage()]);
}

Flight::route('GET /favorites/@user_id', function ($user_id) {
    Flight::json(Flight::get('favorite_service')->get_user_favorites($user_id));
});

Flight::route('POST /favorites', function () {
    $data = Flight::request()->data->getData();
    Flight::get('favorite_service')->add_favorite($data);
    Flight::json(["message" => "Added to favorites"]);
});

Flight::route('DELETE /favorites', function () {
    $data = Flight::request()->data->getData();
    Flight::get('favorite_service')->remove_favorite($data);
    Flight::json(["message" => "Removed from favorites"]);
});

?>

