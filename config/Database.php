<?php

class dataBase
{
    private $host = "your_host";
    private $dbname = "your_database_name"; //En mi caso esp32
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