<?php

require_once("vendor/autoload.php");
$dotenv = Dotenv\Dotenv::createImmutable( realpath("./"));
$dotenv->safeLoad();

class DBConnection
{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    protected function connect(): mysqli
    {
        $this->servername = $_ENV['DB_HOST'];
        $this->username = $_ENV['DB_NAME'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->dbname = $_ENV['DB_USER'];
        return new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }
}