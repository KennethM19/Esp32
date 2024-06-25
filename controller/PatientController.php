<?php

class PatientController
{

    private $MODEL;

    public function __construct()
    {
        require_once("D:\UNMSM\IHC\ESP32\model\HomeModel.php");
        $this->MODEL = new HomeModel();
    }

    public function savePatient($docType, $docNum, $campus, $name, $lastname, $gender)
    {
        return $this->MODEL->addPatient($this->cleanData($docType), $this->cleanData($docNum), $this->cleanData($campus), $this->cleanData($name), $this->cleanData($lastname), $this->cleanData($gender));
    }

    public function cleanData($data)
    {
        $data = strip_tags($data);
        $data = filter_var($data, FILTER_UNSAFE_RAW);
        return htmlspecialchars($data);
    }
}