<?php
namespace Services;

class BaseService {
    protected $dao;

    public function __construct($dao) {
        $this->dao = $dao;
    }

    public function getAll() {
        return $this->dao->getAll();
    }

    public function getById($id) {
        if (!is_numeric($id)) {
            throw new \Exception("Invalid ID.");
        }
        return $this->dao->getById($id);
    }

    public function delete($id) {
        if (!is_numeric($id)) {
            throw new \Exception("Invalid ID.");
        }
        return $this->dao->delete($id);
    }
}
