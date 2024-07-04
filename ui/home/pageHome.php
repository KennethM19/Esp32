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

    document.getElementById('ESP32_01_Temp').innerHTML = "NN";
    document.getElementById('ESP32_01_HBT').innerHTML = "NN";
    document.getElementById('ESP32_01_OXY').innerHTML = "NN";

    getData();

    setInterval(myTimer, 500);

    function myTimer() {
        getData();
    }

    function getData() {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
            const myObj = JSON.parse(this.responseText);
            document.getElementById("ESP32_01_Temp").innerHTML = myObj.temperature;
            document.getElementById("ESP32_01_HBT").innerHTML = myObj.heartbeat;
            document.getElementById("ESP32_01_OXY").innerHTML = myObj.oxygen;
        }
        xmlhttp.open("POST","getDiagnostics.php",true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send();
    }

</script>
</body>
</html>