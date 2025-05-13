<?php
require_once __DIR__ . '/../services/UserService.php';
header('Content-Type: application/json');

$userService = new UserService();

try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $data = json_decode(file_get_contents("php://input"), true);
            $userService->create_user($data);
            echo json_encode(["message" => "User created successfully"]);
            break;

        case 'GET':
            if (isset($_GET['id'])) {
                echo json_encode($userService->get_user_by_id($_GET['id']));
            } else {
                echo json_encode($userService->get_all_users());
            }
            break;

        case 'PUT':
            $data = json_decode(file_get_contents("php://input"), true);
            $userService->update_user($data['id'], $data);
            echo json_encode(["message" => "User updated successfully"]);
            break;

        case 'DELETE':
            $data = json_decode(file_get_contents("php://input"), true);
            $userService->delete_user($data['id']);
            echo json_encode(["message" => "User deleted successfully"]);
            break;

        default:
            http_response_code(405);
            echo json_encode(["error" => "Method Not Allowed"]);
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["error" => $e->getMessage()]);
}

Flight::route('GET /users', function () {
    Flight::json(Flight::get('user_service')->get_all_users());
});

Flight::route('GET /users/@id', function ($id) {
    Flight::json(Flight::get('user_service')->get_user_by_id($id));
});

Flight::route('POST /users', function () {
    $data = Flight::request()->data->getData();
    Flight::get('user_service')->create_user($data);
    Flight::json(["message" => "User created successfully"]);
});

Flight::route('PUT /users/@id', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::get('user_service')->update_user($id, $data);
    Flight::json(["message" => "User updated successfully"]);
});

Flight::route('DELETE /users/@id', function ($id) {
    Flight::get('user_service')->delete_user($id);
    Flight::json(["message" => "User deleted successfully"]);
});

?>
