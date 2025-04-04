<?php
require_once 'BaseDao.php';

class FavoriteDao extends BaseDao {
    public function getUserFavorites($user_id) {
        return $this->query("SELECT * FROM favorites WHERE user_id = ?", [$user_id])->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addFavorite($user_id, $recipe_id) {
        return $this->query("INSERT INTO favorites (user_id, recipe_id) VALUES (?, ?)", [$user_id, $recipe_id]);
    }

    public function removeFavorite($user_id, $recipe_id) {
        return $this->query("DELETE FROM favorites WHERE user_id = ? AND recipe_id = ?", [$user_id, $recipe_id]);
    }
}
?>
