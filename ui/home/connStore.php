<?php
require_once '../../controller/HomeController.php';
$obj = new HomeController();
$user = $_POST["user"];
$campus = $_POST["campus"];
$password = $_POST["password"];
$confirmPassword = $_POST["confirmPassword"];
$error = "";
if (empty($user) || empty($campus) || empty($password) || empty($confirmPassword)) {
    $error .= "<li>Complete todos los campos</li>";
    $error = rawurlencode($error);
    $redirectUrl = "pageNewLogin.php?error=" . $error . "&user=" . $user . "&campus=" . $campus . "&password=" . $password . "&confirmPassword=" . $confirmPassword;
    header("Location: " . $redirectUrl);
    exit;
} else if ($user && $campus && $password && $confirmPassword) {
    if ($password == $confirmPassword) {
        if ($obj->saveNewLogin($user, $campus, $password)) {
            $redirectUrl = "pageRecordPatient.php";
            header("Location: " . $redirectUrl);
        }

    } else {
        $error .= "<li>Contraseñas diferentes</li>";
        $error = rawurlencode($error);
        $redirectUrl = "pageNewLogin.php?error=" . $error . "&user=" . $user . "&campus=" . $campus . "&password=" . $password . "&confirmPassword=" . $confirmPassword;
        header("Location: " . $redirectUrl);
    }
}
