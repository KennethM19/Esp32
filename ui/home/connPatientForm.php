<?php
require_once("../../controller/PatientController.php");
require_once ("../../model/HomeModel.php");
$model = new HomeModel();
$patient = new PatientController();

$docType = $_POST['docType'];
$docType = strtoupper($docType);
$docNum = $_POST['docNum'];
$campus = $_POST['campus'];
$campus = strtoupper($campus);
$idCampus = $model->getIdCampus($campus);
$name = $_POST['name'];
$name = ucwords(strtolower($name));
$lastname = $_POST['lastName'];
$lastname = ucwords(strtolower($lastname));
$gender = $_POST['gender'];
$error = "";

if (empty($docType) || empty($campus) || empty($docNum) || empty($name) || empty($lastname) || empty($gender)) {
    $error .= "<li>Complete todos los campos</li>";
    $error = rawurlencode($error);
    $redirectUrl = "pagePatient.php?id_campus=".($idCampus-2)."&error=" . $error;
    header("Location: " . $redirectUrl);
    exit();
} else {
    if (!is_numeric($docNum) || strlen($docNum) < 7 || strlen($docNum) > 8) {
        $error .= "<li>El número de documento debe ser positivo y de máximo 8 dígitos</li>";
    } else {
        $docNum = str_pad($docNum, 8, "0", STR_PAD_LEFT);
    }
    if (!empty($error)) {
        $error = rawurlencode($error);
        $redirectUrl = "pagePatient.php?id_campus=".($idCampus-2)."&error=" . $error;
        header("Location: " . $redirectUrl);
        exit();
    } else {
        if ($patient->savePatient($docType, $docNum, $campus, $name, $lastname, $gender)) {
            $redirectUrl = "pageHome.php?dni=" . $docNum . "&name=" . $name;
            header("Location: " . $redirectUrl);
        } else {
            echo "Ocurrio un error al guardar los datos";
        }
    }


}