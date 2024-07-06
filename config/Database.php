<?php

class dataBase
{
    private $host = "127.0.0.1:3307";
    private $dbname = "esp32";
    private $user = "root";
    private $pass = "";

    public function connect()
    {
        try {
            $PDO = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            return $PDO;
        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

}

//$obj = new dataBase();
//print_r($obj->connect());