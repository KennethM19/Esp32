<?php
require_once("D:\UNMSM\IHC\ESP32\ui\head\Head.php");
?>
<link rel="stylesheet" href="../../asset/css/LoginStyle.css">
</head>
<body>
<div class="title">
    <h1>Monitoreo de salud</h1>
</div>
<div class="container">

    <form class="login">
        <div>
            <img class="doctor" src="../../img/doctor.png" alt="Doctores">
        </div>
        <section>
            <div class="credential">
                <label for="email">Correo electrónico</label>
                <input type="email" size="30">
            </div>
            <div class="credential">
                <label for="password">Contraseña</label>
                <div class="box-eye">
                    <button type="button" onclick="showPassword('password','eyePassword')">
                        <i id="eyePassword" class="bi bi-eye eyeChange"></i>
                    </button>
                </div>
                <input type="password" value="" size="30" id="password" >
                
            </div>
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </section>

    </form>
</div>


<?php
require_once("D:\UNMSM\IHC\ESP32\ui\head\Footer.php")
?>


