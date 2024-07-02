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

    public function getLastDiagnostic()
    {
        $statement = $this->PDO->prepare("SELECT * FROM diagnostic_test ORDER BY id DESC LIMIT 1");
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result;
            }
        }
        return false;
    }
}