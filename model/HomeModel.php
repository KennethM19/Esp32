<?php

class HomeModel
{
    private $PDO;

    public function __construct()
    {
        require_once("D:\UNMSM\IHC\ESP32\config\Database.php");
        $pdo = new Database();
        $this->PDO = $pdo->connect();
    }

    public function updateUser($user, $password)
    {
        $statement = $this->PDO->prepare("INSERT INTO login VALUES (null, :user, :password)");
        $statement->bindParam(":user", $user);
        $statement->bindParam(":password", $password);
        return ($statement->execute()) ? true : false;
    }

    public function getUsers($user)
    {
        $statement = $this->PDO->prepare("SELECT password FROM login WHERE user = :user");
        $statement->bindParam(":user", $user);
        if ($statement->execute()) {
            $result = $statement->fetch();
            if ($result) {
                return $result['password'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function addPatient($docType, $docNum, $name, $lastname, $gender)
    {
        $statement = $this->PDO->prepare("INSERT INTO patient VALUES (null, :docType, :docNum, :name, :lastname, :gender)");
        $statement->bindParam(":docType", $docType);
        $statement->bindParam(":docNum", $docNum);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":lastname", $lastname);
        $statement->bindParam(":gender", $gender);
        return ($statement->execute()) ? true : false;
    }

    public function getPatients($docNum, $column)
    {
            $statement = $this->PDO->prepare("SELECT * FROM patient WHERE docNum = :docNum");
            $statement->bindParam(":docNum", $docNum);
            if ($statement->execute()) {
                $result = $statement->fetchAll();
                if ($result) {
                    return $result[$column];
                } else {
                    return false;
                }
            } else {
                return false;
            }
    }

}



