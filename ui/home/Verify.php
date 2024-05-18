<?php
require_once '..\..\controller\HomeController.php';
session_start();
$obj = new HomeController();
if (isset($_POST['user']) && isset($_POST['password'])) {
    $user = $obj->cleanData($_POST['user']);
    $password = $obj->cleanData($_POST['password']);
    $isVerified = $obj->verifyUsers($user, $password);
    if ($isVerified) {
        if ($user == 'admin' && $password == 'admin') {
            $_SESSION['user'] = $user;
            session_destroy();
            $redirectUrl = 'NewLogin.php';
            header('location: ' . $redirectUrl);
        } else {
            $_SESSION['user'] = $user;
            $redirectUrl = 'Patient.php';
            header('location: ' . $redirectUrl);
        }
    } else {
        $error = "<li>Credenciales incorrectas</li>";
        header("location:index.php?error=" . $error);
    }

} else {
    echo "No se recibieron los datos del formulario.";
}
