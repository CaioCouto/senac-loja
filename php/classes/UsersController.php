<?php
spl_autoload_register(function($className) {
    require_once(__DIR__ . "\\{$className}.php");
});

class UsersController extends DatabaseConfig {
    public function __construct() {
        parent::__construct();
    }

    public function getUsers() {
        $sql = <<<SQL
        SELECT * FROM users 
        SQL;
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUser($email) {
        $sql = <<<SQL
        SELECT * FROM users WHERE email=:email
        SQL;
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertNewUser($data) {
        $sql = <<<SQL
        INSERT INTO users (name, surname, cpf, gender, email, password, cep, city, address, houseNumber, neighborhood, status) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)
        SQL;
        $stmt = $this->dbh->prepare($sql);
        foreach($data as $key => $value) {
            $stmt->bindValue(($key+1), $value[0], $value[1]);
        }
        return $stmt->execute();
    }

    public function validateUser($email, $password) {
        $sql = <<<SQL
        SELECT name, surname, password, status FROM users WHERE email=?
        SQL;
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(1, $email, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $storedPassword = $data['password'];
        if (password_verify($password, $storedPassword)) {
            return [
                'userEmail' => $email,
                'userFullName' => ucwords($data['name']) . ' ' . ucwords($data['surname']),
                'userStatus' => $data['status']
            ];
        }
        else {
            return false;
        }
    }
    
    public function updateUser($data, $email) {
        $sql = <<<SQL
        UPDATE users SET 
        name=?, surname=?, cpf=?, gender=?, email=?, password=IFNULL(?, password), 
        cep=?, city=?, address=?, houseNumber=?, neighborhood=?, status=IFNULL(?, status)
        WHERE email=?
        SQL;
        $stmt = $this->dbh->prepare($sql);
        foreach($data as $key => $value) {
            $stmt->bindValue(($key+1), $value[0], $value[1]);
        }
        $stmt->bindValue((count($data)+1), $email, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteUser($email) {
        $sql = <<<SQL
        DELETE FROM users WHERE email=:email
        SQL;
        $stmt = $this->dbh->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        return $stmt->execute();
    }
};