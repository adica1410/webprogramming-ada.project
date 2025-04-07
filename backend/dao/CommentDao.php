<?php
require_once 'BaseDao.php';

class CommentDao extends BaseDao {
    public function getAllComments() {
        return $this->query("SELECT * FROM comments")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createComment($user_id, $recipe_id, $comment, $rating) {
        return $this->query("INSERT INTO comments (user_id, recipe_id, comment, rating) VALUES (?, ?, ?, ?)", 
            [$user_id, $recipe_id, $comment, $rating]);
    }

    public function deleteComment($id) {
        return $this->query("DELETE FROM comments WHERE id = ?", [$id]);
    }
}
?>
