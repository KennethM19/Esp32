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

    public function updateEntity($campus, $user, $password)
    {
        $statement = $this->PDO->prepare("INSERT INTO entities VALUES (null,:campus, :user, :password)");
        $statement->bindParam(":user", $user);
        $statement->bindParam(":campus", $campus);
        $statement->bindParam(":password", $password);
        return ($statement->execute()) ? true : false;
    }

    public function getUsers($user)
    {
        $statement = $this->PDO->prepare("SELECT password FROM entities WHERE user = :user");
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

    public function getPatients()
    {
        $statement = $this->PDO->prepare("SELECT * FROM patient");
        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

}



