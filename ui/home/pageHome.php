<?php
require_once('../../config/Sessions.php');
if (empty($_SESSION['user'])) {
    header('location: pageIndex.php');
    exit();
}
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>ESP32 WITH MYSQL DATABASE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/0c2588e818.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/HomeStyle.css">
</head>

<body>
<div class="topnav">
    <h3>ESP32 WITH MYSQL DATABASE</h3>
    <div class="session">
        <a href="connLogout.php" class="button">Cerrar Sesión</a>
    </div>
</div>

<section>
    <h3>PACIENTE</h3>
    <div id="data-student">
        <p>DNI <span id="docNum"></span></p>
        <p>Nombre <span id="name"></span></p>
    </div>
</section>


<div class="cards">

    <div class="card">
        <div class="card header">
            <h3 style="font-size: 1rem;">MONITORING PATIENT</h3>
        </div>

        <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> TEMPERATURE </h4>
        <p class="temperatureColor"><span class="reading"><span id="ESP32_01_Temp"></span> &deg;C</span></p>
        <h4 class="heartbeatColor"><i class="fa fa-heartbeat" aria-hidden="true"></i> HEARTBEAT </h4>
        <p class="heartbeatColor"><span class="reading"><span id="ESP32_01_HBT"></span> &percnt;</span></p>
        <h4 class="oxygenBloodColor"><i class="fas fa-tint"></i> OXYGEN BLOOD</h4>
        <p class="oxygenBloodColor"><span class="reading"><span id="ESP32_01_OXY"></span> &percnt;</span></p>

    </div>


</div>

<br>

<div class="content">
    <div class="cards">
        <div class="card header" style="border-radius: 15px;">
            <button onclick="window.open('recordPatient.php');">Open Record Table</button>
            <h3 style="font-size: 0.7rem;"></h3>
        </div>
    </div>
</div>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const dni = urlParams.get('dni');
    const name = urlParams.get('name');

    document.getElementById("docNum").textContent = dni;
    document.getElementById("name").textContent = name;

    function updateData() {
        fetch("D:\UNMSM\IHC\ESP32\config\getDiagnostics.php")  // Cambia esto por la ruta a tu script PHP que obtiene los datos
            .then(response => response.json())
            .then(data => {
                document.getElementById("ESP32_01_Temp").innerHTML = data.temperature;
                document.getElementById("ESP32_01_HBT").innerHTML = data.heartbeat;
                document.getElementById("ESP32_01_OXY").innerHTML = data.oxygen;
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    setInterval(updateData, 1000);
</script>
</body>
</html>