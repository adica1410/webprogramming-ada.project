<?php
require_once '../../services/CommentService.php';
header('Content-Type: application/json');

$commentService = new CommentService();

try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $data = json_decode(file_get_contents("php://input"), true);
            $commentService->add_comment($data['user_id'], $data['recipe_id'], $data['comment'], $data['rating']);
            echo json_encode(["message" => "Comment added successfully"]);
            break;

        case 'GET':
            if (isset($_GET['recipe_id'])) {
                echo json_encode($commentService->get_comments_by_recipe($_GET['recipe_id']));
            } else {
                echo json_encode($commentService->get_all_comments());
            }
            break;

        case 'DELETE':
            $data = json_decode(file_get_contents("php://input"), true);
            $commentService->delete_comment($data['id']);
            echo json_encode(["message" => "Comment deleted successfully"]);
            break;
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["error" => $e->getMessage()]);
}

Flight::route('GET /comments', function () {
    Flight::json(Flight::get('comment_service')->get_all_comments());
});

Flight::route('GET /comments/@recipe_id', function ($recipe_id) {
    Flight::json(Flight::get('comment_service')->get_comments_by_recipe($recipe_id));
});

Flight::route('POST /comments', function () {
    $data = Flight::request()->data->getData();
    Flight::get('comment_service')->create_comment($data);
    Flight::json(["message" => "Comment added successfully"]);
});

Flight::route('DELETE /comments/@id', function ($id) {
    Flight::get('comment_service')->delete_comment($id);
    Flight::json(["message" => "Comment deleted successfully"]);
});

?>

