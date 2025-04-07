<?php
require_once '../../dao/CommentDao.php';
header('Content-Type: application/json');

$commentDao = new CommentDao();

// CREATE (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $commentDao->createComment($data['user_id'], $data['recipe_id'], $data['comment'], $data['rating']);
    echo json_encode(["message" => "Comment added successfully"]);
}

// READ (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['recipe_id'])) {
        echo json_encode($commentDao->getCommentsByRecipe($_GET['recipe_id']));
    } else {
        echo json_encode($commentDao->getAllComments());
    }
}

// DELETE (DELETE)
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    $commentDao->deleteComment($data['id']);
    echo json_encode(["message" => "Comment deleted successfully"]);
}
?>
