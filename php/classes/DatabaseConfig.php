<?php

class DatabaseConfig {
    protected $dbh;

    protected function __construct() {
        $root = dirname(dirname(__DIR__));
        $this->dbh = new PDO("sqlite:{$root}/loja.sqlite");
        // $this->dbh = new PDO('mysql:host=localhost;dbname=loja', 'root', '');
        $this->createUsersTable();
        $this->createProductsTable();
        $this->createShoppingcartTable();
    }

    // Trecho de código relativo à conexão via SQLite
    private function createUsersTable() {
        $this->dbh->exec('CREATE TABLE IF NOT EXISTS users (
            name TEXT,
            surname TEXT, 
            cpf TEXT,
            gender TEXT,
            email TEXT PRIMARY KEY,
            password TEXT,
            cep TEXT,
            city TEXT,
            address TEXT,
            houseNumber TEXT,
            neighborhood TEXT,
            status TEXT DEFAULT "user"
        )');
    }

    private function createProductsTable() {
        $this->dbh->exec('CREATE TABLE IF NOT EXISTS products (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT, 
            value REAL,
            quantity INTEGER UNSIGNED,
            category TEXT,
            description TEXT,
            image TEXT
        )');
    }

    private function createShoppingcartTable() {
        $this->dbh->exec('CREATE TABLE IF NOT EXISTS shoppingcarts (
            product_id INTEGER,
            user_email TEXT,
            FOREIGN KEY(product_id) REFERENCES Products(id),
            FOREIGN KEY(user_email) REFERENCES Users(email)
        )');
    } 

    // Trecho de código relativo à conexão via MySQL
    /* 
    private function createUsersTable() {
        $this->dbh->exec('CREATE TABLE IF NOT EXISTS users (
            name TEXT,
            surname TEXT, 
            cpf CHAR(14),
            gender TEXT,
            email TEXT PRIMARY KEY,
            password TEXT,
            cep TEXT,
            city TEXT,
            address TEXT,
            houseNumber TEXT,
            neighborhood TEXT,
            status TEXT DEFAULT "user"
        )');
    }

    private function createProductsTable() {
        $this->dbh->exec('CREATE TABLE IF NOT EXISTS products (
            id INTEGER PRIMARY KEY AUTO_INCREMENT,
            name TEXT, 
            value DECIMAL(10, 2),
            quantity INTEGER UNSIGNED,
            category TEXT,
            description TEXT,
            image TEXT
        )');
    }

    private function createShoppingcartTable() {
        $this->dbh->exec('CREATE TABLE IF NOT EXISTS shoppingcarts (
            product_id INTEGER,
            user_email TEXT,
            FOREIGN KEY(product_id) REFERENCES Products(id),
            FOREIGN KEY(user_email) REFERENCES Users(email)
        )');
    } 
    */
}