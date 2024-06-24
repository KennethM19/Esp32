<?php
session_start();
if (!empty($_SESSION['user'])) {
    header('location: recordPatient.php');
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Health</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/LoginStyle.css">
</head>
<body>
<div class="title">
    <h1>Monitoreo de salud</h1>
</div>
<div class="container">
    <div>
        <img class="doctorimg" src="../../img/doctor.png" alt="Doctores">
    </div>
    <form action="Verify.php" method="post" class="login" autocomplete="off">
        <section>
            <div class="credential">
                <label for="user">Usuario</label>
                <input type="text" id="user" name="user" value="">
            </div>
            <div class="credential">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" value="">
            </div>
            <?php if (!empty($_GET['error'])): ?>
                <div id="alertError" class="alert alert-danger mb-2" role="alert">
                    <?= (!empty($_GET['error'])) ? $_GET['error'] : "" ?>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </section>
        <div class="forgetPassword">
            <a href="">¿Olvidó su contraseña?</a>
        </div>
    </form>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>


