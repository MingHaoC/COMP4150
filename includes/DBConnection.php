<?php

$root = str_replace("/index.php", "", realpath('index.php'));
require_once( $root. "/vendor/autoload.php" );
$dotenv = Dotenv\Dotenv::createImmutable( $root);
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

    protected function getStarQuery($sql) {
        $result = $this->connect()->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        }
        return [];
    }

    protected function executeQuery($sql): bool{

    }
}