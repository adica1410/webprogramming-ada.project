<?php
require_once __DIR__ . '/../dao/RecipeDao.php';

class RecipeService {
    private $recipeDao;

    public function __construct() {
        $this->recipeDao = new RecipeDao();
    }

    public function get_all_recipes() {
        return $this->recipeDao->getAllRecipes();
    }

    public function get_recipe_by_id($id) {
        if (!is_numeric($id)) {
            throw new Exception("Invalid recipe ID.");
        }
        return $this->recipeDao->getRecipeById($id);
    }

    public function create_recipe($data) {
        $required = ['name', 'description', 'ingredients', 'instructions', 'prep_time', 'cook_time', 'servings', 'user_id', 'category_id'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                throw new Exception("Missing field: $field");
            }
        }

        return $this->recipeDao->createRecipe(
            $data['name'],
            $data['description'],
            $data['ingredients'],
            $data['instructions'],
            $data['prep_time'],
            $data['cook_time'],
            $data['servings'],
            $data['user_id'],
            $data['category_id']
        );
    }

    public function update_recipe($id, $data) {
        if (!is_numeric($id)) {
            throw new Exception("Invalid recipe ID.");
        }

        $required = ['name', 'description', 'ingredients', 'instructions'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                throw new Exception("Missing field: $field");
            }
        }

        return $this->recipeDao->updateRecipe(
            $id,
            $data['name'],
            $data['description'],
            $data['ingredients'],
            $data['instructions']
        );
    }

    public function delete_recipe($id) {
        if (!is_numeric($id)) {
            throw new Exception("Invalid recipe ID.");
        }
        return $this->recipeDao->deleteRecipe($id);
    }
}
