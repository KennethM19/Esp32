<?php

class Esp32Controller
{
    private $MODEL;

    public function __construct()
    {
        require_once('D:\UNMSM\IHC\ESP32\model\Esp32Model.php');
        $this->MODEL = new Esp32Model();
    }
}