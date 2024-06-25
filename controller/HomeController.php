<?php

class HomeController
{

    private $MODEL;

    public function __construct()
    {
        require_once("D:\UNMSM\IHC\ESP32\model\HomeModel.php");
        $this->MODEL = new HomeModel();
    }

    public function saveNewLogin($user, $campus, $password)
    {
        return $this->MODEL->updateEntity($this->cleanData($campus), $this->cleanData($user), $this->encryptPassword($this->cleanData($password)));
    }

    public function cleanData($data)
    {
        $data = strip_tags($data);
        $data = filter_var($data, FILTER_UNSAFE_RAW);
        return htmlspecialchars($data);
    }

    private function encryptPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyUsers($user, $password)
    {
        echo $keyDb = $this->MODEL->getUsers($user);
        if ($keyDb === false) {
            return false;
        }
        return password_verify($password, $keyDb);
    }
}