<?php

class Esp32Model
{
    private $PDO;

    public function __construct()
    {
        require_once("D:\UNMSM\IHC\ESP32\config\connESP32.php");
        $pdo = new connESP32();
        $this->PDO = $pdo->connect();
    }

}