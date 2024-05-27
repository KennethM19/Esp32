<?php
require_once('../../config/Sessions.php');
if (empty($_SESSION['user'])) {
    header('location: Index.php');
    exit();
}
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>ESP32 WITH MYSQL DATABASE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/0c2588e818.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../asset/css/HomeStyle.css">
</head>

<body>
<div class="topnav">
    <h3>ESP32 WITH MYSQL DATABASE</h3>
    <a href="Logout.php" class="button">Cerrar Sesión</a>
    <a href="recordPatient.php" class="button">Nuevo Paciente</a>
</div>

<section>
    <h3>PACIENTE</h3>
    <div id="data-student">
        <p>DNI <span id="docNum"></span></p>
        <p>Nombre <span id="name"></span></p>
    </div>
</section>


<div class="content">
    <div class="cards">


        <div class="card">
            <div class="card header">
                <h3 style="font-size: 1rem;">MONITORING ROOM</h3>
            </div>


            <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> TEMPERATURE</h4>
            <p class="temperatureColor"><span class="reading"><span id="ESP32_01_Temp"></span> &deg;C</span></p>
            <h4 class="humidityColor"><i class="fas fa-tint"></i> HUMIDITY</h4>
            <p class="humidityColor"><span class="reading"><span id="ESP32_01_Humd"></span> &percnt;</span></p>


            <p class="statusreadColor"><span>Status Read Sensor DHT11 : </span><span
                        id="ESP32_01_Status_Read_DHT11"></span></p>
        </div>
        <div class="card">
            <div class="card header">
                <h3 style="font-size: 1rem;">MONITORING PATIENT</h3>
            </div>


            <h4 class="temperatureColor"><i class="fas fa-thermometer-half"></i> TEMPERATURE </h4>
            <p class="temperatureColor"><span class="reading"><span id="ESP32_01_Temp"></span> &deg;C</span></p>
            <h4 class="heartbeatColor"><i class="fa fa-heartbeat" aria-hidden="true"></i> HEARTBEAT </h4>
            <p class="humidityColor"><span class="reading"><span id="ESP32_01_Humd"></span> &percnt;</span></p>
            <h4 class="oxygenBloodColor"><i class="fas fa-tint"></i> OXYGEN BLOOD</h4>


            <p class="statusreadColor"><span>Status Read Sensor DHT11 : </span><span
                        id="ESP32_01_Status_Read_DHT11"></span></p>
        </div>

        <div class="card">
            <div class="card header">
                <h3 style="font-size: 1rem;">CONTROLLING</h3>
            </div>


            <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> LED 1</h4>
            <label class="switch">
                <input type="checkbox" id="ESP32_01_TogLED_01" onclick="GetTogBtnLEDState('ESP32_01_TogLED_01')">
                <div class="sliderTS"></div>
            </label>
            <h4 class="LEDColor"><i class="fas fa-lightbulb"></i> LED 2</h4>
            <label class="switch">
                <input type="checkbox" id="ESP32_01_TogLED_02" onclick="GetTogBtnLEDState('ESP32_01_TogLED_02')">
                <div class="sliderTS"></div>
            </label>

        </div>

    </div>
</div>

<br>

<div class="content">
    <div class="cards">
        <div class="card header" style="border-radius: 15px;">
            <h3 style="font-size: 0.7rem;">LAST TIME RECEIVED DATA FROM ESP32 [ <span id="ESP32_01_LTRD"></span> ]</h3>
            <button onclick="window.open('recordPatient.php');">Open Record Table</button>
            <h3 style="font-size: 0.7rem;"></h3>
        </div>
    </div>
</div>

<script>
    const urlParams = new URLSearchParams(window.location.search);
    const dni = urlParams.get('dni');
    const name = urlParams.get('name');

    document.getElementById("ESP32_01_Temp").innerHTML = "NN";
    document.getElementById("ESP32_01_Humd").innerHTML = "NN";
    document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = "NN";
    document.getElementById("ESP32_01_LTRD").innerHTML = "NN";
    document.getElementById('docNum').textContent = dni;
    document.getElementById('name').textContent = name;


    Get_Data("esp32_01");

    setInterval(myTimer, 5000);

    function myTimer() {
        Get_Data("esp32_01");
    }

    function Get_Data(id) {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                const myObj = JSON.parse(this.responseText);
                if (myObj.id === "esp32_01") {
                    document.getElementById("ESP32_01_Temp").innerHTML = myObj.temperature;
                    document.getElementById("ESP32_01_Humd").innerHTML = myObj.humidity;
                    document.getElementById("ESP32_01_Status_Read_DHT11").innerHTML = myObj.status_read_sensor_dht11;
                    document.getElementById("ESP32_01_LTRD").innerHTML = "Time : " + myObj.ls_time + " | Date : " + myObj.ls_date + " (dd-mm-yyyy)";
                    if (myObj.LED_01 === "ON") {
                        document.getElementById("ESP32_01_TogLED_01").checked = true;
                    } else if (myObj.LED_01 === "OFF") {
                        document.getElementById("ESP32_01_TogLED_01").checked = false;
                    }
                    if (myObj.LED_02 === "ON") {
                        document.getElementById("ESP32_01_TogLED_02").checked = true;
                    } else if (myObj.LED_02 === "OFF") {
                        document.getElementById("ESP32_01_TogLED_02").checked = false;
                    }
                }
            }
        };
        xmlhttp.open("POST", "getdata.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id=" + id);
    }

    function GetTogBtnLEDState(togbtnid) {
        if (togbtnid === "ESP32_01_TogLED_01") {
            var togbtnchecked = document.getElementById(togbtnid).checked;
            var togbtncheckedsend = "";
            if (togbtnchecked === true) togbtncheckedsend = "ON";
            if (togbtnchecked === false) togbtncheckedsend = "OFF";
            Update_LEDs("esp32_01", "LED_01", togbtncheckedsend);
        }
        if (togbtnid === "ESP32_01_TogLED_02") {
            var togbtnchecked = document.getElementById(togbtnid).checked;
            var togbtncheckedsend = "";
            if (togbtnchecked === true) togbtncheckedsend = "ON";
            if (togbtnchecked === false) togbtncheckedsend = "OFF";
            Update_LEDs("esp32_01", "LED_02", togbtncheckedsend);
        }
    }

    function Update_LEDs(id, lednum, ledstate) {
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
            }
        }
        xmlhttp.open("POST", "updateLEDs.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("id=" + id + "&lednum=" + lednum + "&ledstate=" + ledstate);
    }
</script>
</body>
</html>
