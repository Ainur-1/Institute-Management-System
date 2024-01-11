<?php
class Database {
    private $servername = "localhost";
    private $username = "admin";
    private $password = '$dmin77Q';
    private $dbname = "ims";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}