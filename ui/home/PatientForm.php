<?php
require_once("../../controller/PatientController.php");
$patient = new PatientController();

$docType = $_POST['docType'];
$docNum = $_POST['docNum'];
$name = $_POST['name'];
$name = ucwords(strtolower($name));
$lastname = $_POST['lastName'];
$lastname = ucwords(strtolower($lastname));
$age = $_POST['age'];
$gender = $_POST['gender'];
$error = "";

if (empty($docType) || empty($docNum) || empty($name) || empty($lastname) || empty($age) || empty($gender)) {
    $error .= "<li>Complete todos los campos</li>";
    $error = rawurlencode($error);
    $redirectUrl = "Patient.php?error=".$error;
    header("Location: " . $redirectUrl);
    exit();
} else {
    if (!is_numeric($docNum) || strlen($docNum) < 7 || strlen($docNum) > 8) {
        $error .= "<li>El número de documento debe ser positivo y de máximo 8 dígitos</li>";
    } else {
        $docNum = str_pad($docNum,8,"0",STR_PAD_LEFT);
    }

    if (!is_numeric($age) || $age < 0 || $age > 999) {
        $error .= "<li>La edad debe ser un número positivo de hasta 3 cifras.</li>";
    } else {
        $age= (int)$age;
    }

    if(!empty($error)) {
        $error = rawurlencode($error);
        $redirectUrl = "Patient.php?error=".$error;
        header("Location: " . $redirectUrl);
        exit();
    } else {
        if ($patient->savePatient($docType, $docNum, $name, $lastname, $age, $gender)) {
            $redirectUrl =  "Home.php";
            header("Location: " . $redirectUrl);
        } else {
            echo "Ocurrio un error al guardar los datos";
        }
    }


}


