<?php
require_once __DIR__ . '/../dao/CommentDao.php';

class CommentService {
    private $commentDao;

    public function __construct() {
        $this->commentDao = new CommentDao();
    }

    public function get_all_comments() {
        return $this->commentDao->getAllComments();
    }

    public function create_comment($data) {
        if (empty($data['user_id']) || empty($data['recipe_id']) || empty($data['comment'])) {
            throw new Exception("Missing required comment fields.");
        }

        $rating = isset($data['rating']) ? intval($data['rating']) : null;
        if ($rating !== null && ($rating < 1 || $rating > 5)) {
            throw new Exception("Rating must be between 1 and 5.");
        }

        return $this->commentDao->createComment(
            $data['user_id'],
            $data['recipe_id'],
            $data['comment'],
            $rating
        );
    }

    public function delete_comment($id) {
        if (!is_numeric($id)) {
            throw new Exception("Invalid comment ID.");
        }

        return $this->commentDao->deleteComment($id);
    }
}
