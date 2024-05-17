<?php

class HomeController
{

    private $MODEL;

    public function __construct()
    {
        require_once("D:\UNMSM\IHC\ESP32\model\HomeModel.php");
        $this->MODEL = new HomeModel();
    }

    public function saveNewLogin($user, $password)
    {
        return $this->MODEL->updateUser($this->cleanData($user), $this->encryptPassword($this->cleanData($password)));
    }

    public function cleanData($password)
    {
        $password = strip_tags($password);
        $password = filter_var($password, FILTER_UNSAFE_RAW);
        return htmlspecialchars($password);
    }

    public function encryptPassword($password)
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
