<?php
require_once '../../controller/HomeController.php';
$obj = new HomeController();
$user = $_POST["user"];
$password = $_POST["password"];
$confirmPassword = $_POST["confirmPassword"];
$error = "";
if (empty($user) || empty($password) || empty($confirmPassword)) {
    $error .= "<li>Complete todos los campos</li>";
    $error = rawurlencode($error);
    $redirectUrl = "NewLogin.php?error=" . $error . "&user=" . $user . "&password=" . $password . "&confirmPassword=" . $confirmPassword;
    header("Location: " . $redirectUrl);
    exit;
} else if ($user && $password && $confirmPassword) {
    if ($password == $confirmPassword) {
        if ($obj->saveNewLogin($user, $password)) {
            $redirectUrl = "Patient.php";
            header("Location: " . $redirectUrl);
        }

    } else {
        $error .= "<li>Contraseñas diferentes</li>";
        $error = rawurlencode($error);
        $redirectUrl = "NewLogin.php?error=" . $error . "&user=" . $user . "&password=" . $password . "&confirmPassword=" . $confirmPassword;
        header("Location: " . $redirectUrl);
    }
}
