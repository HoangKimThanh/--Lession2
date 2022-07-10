<?php

require_once 'config/config.php';

class Database
{
    private string $host = DB_HOST;
    private string $user = DB_USER;
    private string $pass = DB_PASS;
    private string $dbname = DB_NAME;

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            die('Connection error: ' . $this->conn->connect_error);
        }
    }

    // query select statement
    public function select($query): Object
    {
        $result = $this->conn->query($query) or
            die($this->conn->error . __LINE__);

        return $result;
    }

    // query for insert, update, delete statement
    public function execute($query): void
    {
        $this->conn->query($query) or
            die($this->conn->error . __LINE__);
    }
}
