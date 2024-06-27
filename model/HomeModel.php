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
        $statement = $this->PDO->prepare("INSERT INTO entities VALUES (null, :campus, :user, :password)");
        $statement->bindParam(":campus", $campus);
        $statement->bindParam(":user", $user);
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

    public function addPatient($docType, $docNum, $campus, $name, $lastname, $gender)
    {
        $statement = $this->PDO->prepare("INSERT INTO patient_student VALUES (null, :campus, :docType, :docNum, :name, :lastname, :gender)");
        $statement->bindParam(":docType", $docType);
        $statement->bindParam(":docNum", $docNum);
        $idCampus = $this->getIdCampus($campus);
        $statement->bindParam(":campus", $idCampus);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":lastname", $lastname);
        $statement->bindParam(":gender", $gender);
        return ($statement->execute()) ? true : false;
    }

    public function getPatients($idCampus)
    {
        $statement = $this->PDO->prepare("SELECT * FROM patient_student where id_campus = :idcampus");
        $statement->bindParam(":idcampus", $idCampus);
        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getIdCampus($campus)
    {
        $statement = $this->PDO->prepare("SELECT id FROM entities WHERE campus = :campus");
        $statement->bindParam(":campus", $campus);
        if ($statement->execute()) {
            $result = $statement->fetch();
            if ($result) {
                return $result['id'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getIdCampus2($user)
    {
        $statement = $this->PDO->prepare("SELECT id FROM entities WHERE user = :user");
        $statement->bindParam(":user", $user);
        if ($statement->execute()) {
            $result = $statement->fetch();
            if ($result) {
                return $result['id'];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}