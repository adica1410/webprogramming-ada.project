<?php
require_once 'BaseDao.php';

class CategoryDao extends BaseDao {
    public function getAllCategories() {
        return $this->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryById($id) {
        return $this->query("SELECT * FROM categories WHERE id = ?", [$id])->fetch(PDO::FETCH_ASSOC);
    }

    public function createCategory($name, $description) {
        return $this->query("INSERT INTO categories (name, description) VALUES (?, ?)", [$name, $description]);
    }

    public function updateCategory($id, $name, $description) {
        return $this->query("UPDATE categories SET name = ?, description = ? WHERE id = ?", [$name, $description, $id]);
    }

    public function deleteCategory($id) {
        return $this->query("DELETE FROM categories WHERE id = ?", [$id]);
    }
}
?>
