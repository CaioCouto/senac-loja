<?php

class DatabaseConfig {
    protected $dbh;

    protected function __construct() {
        $this->dbh = new PDO('mysql:host=localhost;dbname=loja', 'root', '');
        $this->createUsersTable();
        $this->createProductsTable();
        $this->createShoppingcartTable();
    }
    
    private function createUsersTable() {
        $this->dbh->exec('CREATE TABLE IF NOT EXISTS users (
            name VARCHAR(25),
            surname VARCHAR(100), 
            cpf CHAR(14),
            gender VARCHAR(2),
            email VARCHAR(60) PRIMARY KEY,
            password VARCHAR(255),
            cep VARCHAR(9),
            city VARCHAR(50),
            address VARCHAR(100),
            houseNumber VARCHAR(5),
            neighborhood VARCHAR(50),
            status VARCHAR(6) DEFAULT "user"
        )');
    }

    private function createProductsTable() {
        $this->dbh->exec('CREATE TABLE IF NOT EXISTS products (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(255), 
            value DECIMAL(10, 2),
            quantity INTEGER UNSIGNED,
            category VARCHAR(50),
            description VARCHAR(65535),
            image VARCHAR(255)
        )');
    }

    private function createShoppingcartTable() {
        $this->dbh->exec('CREATE TABLE IF NOT EXISTS shoppingcarts (
            product_id INTEGER,
            user_email VARCHAR(60),
            FOREIGN KEY(product_id) REFERENCES Products(id),
            FOREIGN KEY(user_email) REFERENCES Users(email)
        )');
    }
}