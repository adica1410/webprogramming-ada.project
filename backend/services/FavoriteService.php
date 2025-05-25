<?php
require_once __DIR__ . '/../dao/FavoriteDao.php';
require_once __DIR__ . '/BaseService.php';

class FavoriteService extends BaseService{
    private $favoriteDao;

    public function __construct() {
        $this->favoriteDao = new FavoriteDao();
    }

    public function get_user_favorites($user_id) {
        if (!is_numeric($user_id)) {
            throw new Exception("Invalid user ID.");
        }
        return $this->favoriteDao->getUserFavorites($user_id);
    }

    public function add_favorite($data) {
        if (empty($data['user_id']) || empty($data['recipe_id'])) {
            throw new Exception("Missing user_id or recipe_id.");
        }

        return $this->favoriteDao->addFavorite($data['user_id'], $data['recipe_id']);
    }

    public function remove_favorite($data) {
        if (empty($data['user_id']) || empty($data['recipe_id'])) {
            throw new Exception("Missing user_id or recipe_id.");
        }

        return $this->favoriteDao->removeFavorite($data['user_id'], $data['recipe_id']);
    }
}
