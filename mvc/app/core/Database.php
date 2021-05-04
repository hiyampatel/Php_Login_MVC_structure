<?php

class Database
{
    private $servername;
    private $username;
    private $password;
    private $db;
    public $conn;

    public function __construct()
    {
        $this->create_connection();
    }

    private function create_connection()
    {
        $this->servername = 'localhost';
        $this->username = 'root';
        $this->password = 'hiya1234';
        $this->db = 'PHP_MVC_Login';

        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->db);

        // Check connection
        if ($this->conn->connect_error)
        {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}

?>
