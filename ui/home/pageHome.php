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

<section class="student">
    <h3>PACIENTE</h3>
    <div id="data-student" class="data-student">
        <p>DNI: </p><span id="docNum"></span>
        <p>Nombre: </p><span id="name"></span>
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

<div class="content">
    <div class="cards">
        <div class="card footer" style="border-radius: 15px;">
            <button onclick="saveData()">Guardar datos</button>
            <button onclick="openRecordTable()">Open Record Table</button>
        </div>
    </div>
</div>

<script>

    document.getElementById('docNum').innerText = getUrlParameter('dni');
    document.getElementById('name').innerText = getUrlParameter('name');
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

    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    function saveData() {
        var dni = getUrlParameter('dni');
        var temperature = document.getElementById("ESP32_01_Temp").innerText;
        var heartbeat = document.getElementById("ESP32_01_HBT").innerText;
        var oxygen = document.getElementById("ESP32_01_OXY").innerText;

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const response = JSON.parse(this.responseText);
                if (response.status === 'success') {
                    alert(response.message);
                } else {
                    alert('Error: ' + response.message);
                }
            }
        }

        xmlhttp.open("POST", "connDataBase.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("dni=" + dni + "&temperature=" + temperature + "&heartbeat=" + heartbeat + "&oxygen=" + oxygen);
    }

    function openRecordTable() {
        var dni = getUrlParameter('dni');
        var url = 'pageRecordDiagnostic.php?dni=' + dni;
        window.location.href = url;
    }
</script>
</body>
</html>