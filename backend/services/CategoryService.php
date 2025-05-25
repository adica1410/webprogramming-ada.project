<?php
require_once __DIR__ . '/../dao/CategoryDao.php';
require_once __DIR__ . '/BaseService.php';

class CategoryService extends BaseService {
    private $categoryDao;

    public function __construct() {
        $this->categoryDao = new CategoryDao();
    }

    public function get_all_categories() {
        return $this->categoryDao->getAllCategories();
    }

    public function get_category_by_id($id) {
        if (!is_numeric($id)) {
            throw new Exception("Invalid ID");
        }
        return $this->categoryDao->getCategoryById($id);
    }

    public function create_category($data) {
        if (empty($data['name'])) {
            throw new Exception("Category name is required.");
        }
        $description = $data['description'] ?? '';
        return $this->categoryDao->createCategory($data['name'], $description);
    }

    public function update_category($id, $data) {
        if (empty($data['name'])) {
            throw new Exception("Category name is required.");
        }
        $description = $data['description'] ?? '';
        return $this->categoryDao->updateCategory($id, $data['name'], $description);
    }

    public function delete_category($id) {
        if (!is_numeric($id)) {
            throw new Exception("Invalid ID");
        }
        return $this->categoryDao->deleteCategory($id);
    }
}
