<?php
require_once 'BaseDao.php';

class RecipeDao extends BaseDao {
    public function getAllRecipes() {
        return $this->query("SELECT * FROM recipes")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecipeById($id) {
        return $this->query("SELECT * FROM recipes WHERE id = ?", [$id])->fetch(PDO::FETCH_ASSOC);
    }

    public function createRecipe($name, $description, $ingredients, $instructions, $prep_time, $cook_time, $servings, $user_id, $category_id) {
        return $this->query("INSERT INTO recipes (name, description, ingredients, instructions, prep_time, cook_time, servings, user_id, category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", 
            [$name, $description, $ingredients, $instructions, $prep_time, $cook_time, $servings, $user_id, $category_id]);
    }
    public function updateRecipe($id, $name, $description, $ingredients, $instructions) {
        $sql = "UPDATE recipes SET name = ?, description = ?, ingredients = ?, instructions = ? WHERE id = ?";
        $this->executeQuery($sql, [$name, $description, $ingredients, $instructions, $id]);
    }

    public function deleteRecipe($id) {
        return $this->query("DELETE FROM recipes WHERE id = ?", [$id]);
    }
}
?>
