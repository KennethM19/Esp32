<?php
require_once("D:\UNMSM\IHC\ESP32\ui\head\Head.php");
if (!empty($_SESSION['user'])){
    header('location: Patient.php');
}
?>
<link rel="stylesheet" href="../../asset/css/LoginStyle.css">
</head>
<body>
<div class="title">
    <h1>Monitoreo de salud</h1>
</div>
<div class="container">

    <form action="Verify.php" method="post" class="login" autocomplete="off">
        <div>
            <img class="doctor" src="../../img/doctor.png" alt="Doctores">
        </div>
        <section>
            <div class="credential">
                <label for="user">Usuario</label>
                <input type="text" id="user" name="user" size="30" value="" required>
            </div>
            <div class="credential">
                <label for="password">Contraseña</label>
                <div class="box-eye">
                    <button type="button" onclick="showPassword('password', 'eyePassword')">
                        <i id="eyePassword" class="bi bi-eye eyeChange"></i>
                    </button>
                </div>
                <input type="password" id="password" name="password" size="30" value="" required>
            </div>
            <?php if (!empty($_GET['error'])): ?>
                <div id="alertError" class="alert alert-danger mb-2" role="alert">
                    <?= (!empty($_GET['error'])) ? $_GET['error'] : "" ?>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Ingresar</button>
        </section>
    </form>

</div>


<?php
require_once("D:\UNMSM\IHC\ESP32\ui\head\Footer.php")
?>


