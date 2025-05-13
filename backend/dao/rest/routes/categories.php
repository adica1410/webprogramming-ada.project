<?php
require_once '../../services/CategoryService.php';
header('Content-Type: application/json');

$categoryService = new CategoryService();

try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $data = json_decode(file_get_contents("php://input"), true);
            $categoryService->create_category($data['name'], $data['description']);
            echo json_encode(["message" => "Category created successfully"]);
            break;

        case 'GET':
            if (isset($_GET['id'])) {
                echo json_encode($categoryService->get_category_by_id($_GET['id']));
            } else {
                echo json_encode($categoryService->get_all_categories());
            }
            break;

        case 'PUT':
            $data = json_decode(file_get_contents("php://input"), true);
            $categoryService->update_category($data['id'], $data['name'], $data['description']);
            echo json_encode(["message" => "Category updated successfully"]);
            break;

        case 'DELETE':
            $data = json_decode(file_get_contents("php://input"), true);
            $categoryService->delete_category($data['id']);
            echo json_encode(["message" => "Category deleted successfully"]);
            break;
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["error" => $e->getMessage()]);
}

Flight::route('GET /categories', function () {
    Flight::json(Flight::get('category_service')->get_all_categories());
});

Flight::route('GET /categories/@id', function ($id) {
    Flight::json(Flight::get('category_service')->get_category_by_id($id));
});

Flight::route('POST /categories', function () {
    $data = Flight::request()->data->getData();
    Flight::get('category_service')->create_category($data);
    Flight::json(["message" => "Category created successfully"]);
});

Flight::route('PUT /categories/@id', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::get('category_service')->update_category($id, $data);
    Flight::json(["message" => "Category updated successfully"]);
});

Flight::route('DELETE /categories/@id', function ($id) {
    Flight::get('category_service')->delete_category($id);
    Flight::json(["message" => "Category deleted successfully"]);
});

?>
