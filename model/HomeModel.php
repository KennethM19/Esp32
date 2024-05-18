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

    public function addPatient($name,$lastname,$age,$gender)
    {
        $statement = $this->PDO->prepare("INSERT INTO patient VALUES (null, :name, :lastname, :age, :gender)");
        $statement->bindParam(":name", $name);
        $statement->bindParam(":lastname", $lastname);
        $statement->bindParam(":age", $age);
        $statement->bindParam(":gender", $gender);
        return ($statement->execute()) ? true : false;
    }
}



