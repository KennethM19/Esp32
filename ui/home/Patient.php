<?php
require_once('../../config/Sessions.php');
if (empty($_SESSION['user'])) {
    header('location: Index.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>ESP32 WITH MYSQL DATABASE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="icon" href="data:,">
    <link rel="stylesheet" href="../../asset/css/PatientStyle.css">
</head>

<body>
<div class="top">
    <h3>ESP32 WITH MYSQL DATABASE</h3>
    <a href="Logout.php" class="button">Cerrar Sesión</a>
</div>



<div class="content">
    <div class="card header ">
        <h3 style="font-size: 1rem;">PACIENTE</h3>
    </div>
    <form action="Home.php" method="post">
        <div>
            <label for="">Nombre:</label>
            <input type="text">
        </div>
        <div>
            <label for="">Apellido</label>
            <input type="text">
        </div>
        <div>
            <label for="">DNI</label>
            <input type="text">
        </div>
        <div>
            <label for="">Edad</label>
            <input type="text">
        </div>
        <div>
            <input type="radio">
            <label for="Masculino">Masculino</label>
            <input type="radio">
            <label for="Femenino">Femenino</label>
        </div>

        <button type="submit">Enviar</button>
    </form>


</div>


<br>

</body>
</html>
