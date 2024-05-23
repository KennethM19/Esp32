<?php

class recordPatientConroller{

    private $MODEL;
    public function __construct()
    {
        require_once ("D:\UNMSM\IHC\ESP32\model\HomeModel.php");
        $this->MODEL = new HomeModel();
    }


}