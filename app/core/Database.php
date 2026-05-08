<?php

class Database {
    private $conn;

    public function __construct($dbKey) {
        $this->connect($dbKey);
    }

    private function connect($dbKey) {
        $dbKey = strtoupper($dbKey);
        $dbNameConst = "DB_$dbKey";

        if (!defined($dbNameConst)) {
            throw new Exception("Databas $dbNameConst är inte definierad i config.php");
        }

        try {
            $this->conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . constant($dbNameConst) . ";charset=utf8mb4",
                DB_USER,
                DB_PASS
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($sql, $params = []) {
        $this->query($sql, $params);
        return $this->conn->lastInsertId();
    }

    public function update($sql, $params = []) {
        return $this->query($sql, $params)->rowCount();
    }

    public function delete($sql, $params = []) {
        return $this->query($sql, $params)->rowCount();
    }
}