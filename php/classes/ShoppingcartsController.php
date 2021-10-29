<?php
spl_autoload_register(function($className) {
    require_once(__DIR__ . "\\{$className}.php");
});

class ShoppingcartsController extends DatabaseConfig {
    public function __construct() {
        parent::__construct();
    }
    
    public function getShoppingcart($email) {
        $sql = <<<SQL
        SELECT Shoppingcarts.product_id, Products.name, Products.value, Products.image, 
        Users.address, Users.city, Users.houseNumber, Users.cep, 
        Users.neighborhood, COUNT(Shoppingcarts.product_id), SUM(Products.value) FROM shoppingcarts 
        INNER JOIN products ON Shoppingcarts.product_id = Products.id 
        INNER JOIN users ON Shoppingcarts.user_email = Users.email 
        WHERE Shoppingcarts.user_email=:email 
        GROUP BY Shoppingcarts.product_id
        SQL;
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function insertProduct($data) {
        $sql = 'INSERT INTO shoppingcarts (product_id, user_email) VALUES (?,?)';
        $stmt = $this->dbh->prepare($sql);
        foreach($data as $key => $value) {
            $stmt->bindValue(($key+1), $value[0], $value[1]);
        }
        return $stmt->execute();
    }

    public function deleteProduct($id) {
        $sql = <<<SQL
        DELETE FROM shoppingcarts WHERE product_id=:id LIMIT 1
        SQL;
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function clearCart($email) {
        $sql = <<<SQL
        DELETE FROM shoppingcarts WHERE user_email=:email
        SQL;
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_INT);
        return $stmt->execute();
    }
};