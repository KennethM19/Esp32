<?php
require_once("D:\UNMSM\IHC\ESP32\ui\head\Head.php");
if (!empty($_SESSION['user'])) {
    header('location: recordPatient.php');
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
            <img class="doctorimg" src="../../img/doctor.png" alt="Doctores">
        </div>
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
    </form>

</div>


<?php
require_once("D:\UNMSM\IHC\ESP32\ui\head\Footer.php")
?>


