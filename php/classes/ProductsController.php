<?php
spl_autoload_register(function($className) {
    require_once(__DIR__ . "\\{$className}.php");
});

class ProductsController extends DatabaseConfig {
    public function __construct() {
        parent::__construct();
    }

    public function getProducts() {
        $sql = 'SELECT * FROM products';
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduct($id) {
        $sql = 'SELECT * FROM products WHERE id=:id';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertNewProduct($data) {
        $sql = 'INSERT INTO products (name, value, description, quantity, image, category) VALUES (?,?,?,?,?,?)';
        $stmt = $this->dbh->prepare($sql);
        foreach($data as $key => $value) {
            $stmt->bindValue(($key+1), $value[0], $value[1]);
        }
        return $stmt->execute();
    }
    
    public function updateProductData($data, $id) {
        $sql = 'UPDATE products SET name=?, value=?, quantity=?, category=?, description=?, image=IFNULL(?, image) WHERE id=?';
        $stmt = $this->dbh->prepare($sql);
        foreach($data as $key => $value) {
            $stmt->bindValue(($key+1), $value[0], $value[1]);
        }
        $stmt->bindValue((count($data)+1), $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteProduct($id) {
        $sql = 'DELETE FROM products WHERE id=:id';
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
};