<?php
require_once __DIR__ . '/../config.php';

class BaseDao {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::connect();
    }

    protected function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
?>
