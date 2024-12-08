<?php
class Database {
    private $conn;

    // Constructor to initialize the connection
    public function __construct($host, $username, $password, $dbname) {
        $this->conn = new mysqli($host, $username, $password, $dbname);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Method to execute queries
    public function query($sql) {
        return $this->conn->query($sql);
    }

    // Method to prepare and execute a prepared statement
    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    // Close the connection
    public function close() {
        $this->conn->close();
    }
}
