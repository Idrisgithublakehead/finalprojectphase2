<?php

class Database {

    private $host = "172.31.22.43";
    private $username = "Idris200627987";
    private $password = "LR07Wuh7XG";
    private $dbName = "Idris200627987";

    public $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $error) {
            echo "Database Connection Failed: " . $error->getMessage();
            exit();
        }
    }
}
?>
