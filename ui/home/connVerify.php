<?php
require_once '..\..\controller\HomeController.php';
session_start();
$obj = new HomeController();
if (isset($_POST['user']) && isset($_POST['password'])) {
    $user = $obj->cleanData($_POST['user']);
    $password = $obj->cleanData($_POST['password']);
    $isVerified = $obj->verifyUsers($user, $password);
    if ($isVerified) {
        $_SESSION['user'] = $user;
        if ($user == 'admin') {
            $redirectUrl = 'pageIndexAdmin.php';
        } else {
            $redirectUrl = 'pageRecordPatient.php';
        }
        header('location: ' . $redirectUrl);
        exit();
    } else {
        $error = "<li>Credenciales incorrectas</li>";
        header("location:pageIndex.php?error=" . $error);
    }

} else {
    echo "No se recibieron los datos del formulario.";
}