<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'clients_accounts';
    private $username = 'tester';
    private $password = 'test';
    private $conn;

    // Метод для получения соединения с базой данных
    public function getConnection() {
        $this->conn = null;

        try {
            // Устанавливаем соединение с базой данных
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
