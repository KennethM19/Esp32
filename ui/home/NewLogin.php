<?php
require_once("D:\UNMSM\IHC\ESP32\ui\head\Head.php");
?>
<link rel="stylesheet" href="../../asset/css/NewLoginStyle.css">
</head>
<body>
<div class="title">
    <h1>Monitoreo de salud</h1>
</div>
<div class="container">

    <form action="Store.php" method="post" autocomplete="off" class="login">
        <div>
            <img class="doctor" src="../../img/doctor.png" alt="Doctores">
        </div>
        <section>
            <div class="credential">
                <label for="text">Nuevo usuario</label>
                <input type="text" name="user" value="<?= (!empty($_GET["user"])) ? $_GET["user"] : "" ?>" size="30">
            </div>
            <div class="credential">
                <label for="password">Nueva contraseña</label>
                <div class="box-eye">
                    <button type="button" onclick="showPassword('password','eyePassword')">
                        <i id="eyePassword" class="bi bi-eye eyeChange"></i>
                    </button>
                </div>
                <input type="password" size="30" name="password" id="password">
                <label for="password">Confirmar contraseña</label>
                <div class="box-eye">
                    <button type="button" onclick="showPassword('confirmPassword','eyePassword2')">
                        <i id="eyePassword2" class="bi bi-eye eyeChange"></i>
                    </button>
                </div>
                <input type="password" name="confirmPassword" size="30" id="confirmPassword">
            </div>
            <?php if (!empty($_GET['error'])): ?>
                <div id="alertError" class="alert alert-danger mb-2" role="alert">
                    <?= (!empty($_GET['error'])) ? $_GET['error'] : "" ?>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </section>

    </form>
</div>
<?php
require_once("D:\UNMSM\IHC\ESP32\ui\head\Footer.php")
?>
