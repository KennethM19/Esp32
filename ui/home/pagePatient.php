<?php
require_once('../../config/Sessions.php');
require_once("../../data/campus.php");
if (empty($_SESSION['user'])) {
    header('location: pageIndex.php');
    exit();
}
$campus = new Campus();
$data = $campus->facultades;
$idCampus = isset($_GET['id_campus']) ? $_GET['id_campus'] : "";
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>ESP32 WITH MYSQL DATABASE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
    <link rel="icon" href="data:,">
    <link rel="stylesheet" href="../css/PatientStyle.css">
</head>

<body>
<div class="topnav">
    <h3>ESP32 WITH MYSQL DATABASE</h3>
    <div class="session">
        <a href="connLogout.php" class="button">Cerrar Sesión</a>
    </div>
</div>

<br>

<div class="content">
    <div class=" ">
        <h3 style="font-size: 1rem;">PACIENTE</h3>

    </div>
    <form action="connPatientForm.php" method="post" autocomplete="off" class="patient">
        <div>
            <label for="document">Doc Identidad</label>
            <select name="docType" id="identity">
                <option value="dni">DNI</option>
                <option value="pasaporte">Pasaporte</option>
            </select>
            <input type="text" name="docNum" autocomplete="off">
        </div>
        <div>
            <label for="text">Facultad</label>
            <select class="selectCampus" name="campus" id="campus" style="max-width: 300px">
                <?php
                echo "<option value='" . $data[$idCampus] . "'>" . $data[$idCampus] . "</option>"
                ?>
            </select>
        </div>
        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" autocomplete="off">
        </div>
        <div>
            <label for="lastname">Apellido</label>
            <input type="text" name="lastName" autocomplete="off">
        </div>
        <div>
            <label for="gender">Género</label>
            <select name="gender" id="gender">
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
            </select>
        </div>
        <?php if (!empty($_GET['error'])): ?>
            <div id="alertError" class="alert alert-danger mb-2" role="alert">
                <?= (!empty($_GET['error'])) ? $_GET['error'] : "" ?>
            </div>
        <?php endif; ?>
        <button type="submit">Enviar</button>
    </form>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>