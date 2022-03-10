<?php

class Database
{
    //DB Param
    private $host = "localhost";
    private $db_name = "bookstore";
    private $username = "root";
    private $password = "";
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    private $conn;

    //DB Connect
    public function connect(): PDO
    {
        try
        {
            $dsn = "mysql:host=$this->host;dbname=$this->db_name";
            $this->conn = new PDO($dsn,$this->username,$this->password,$this->options);
        }
        catch (PDOException $e)
        {
            echo "connection failed". $e->getMessage();
        }
        return $this->conn;

    }

}
