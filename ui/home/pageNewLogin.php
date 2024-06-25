<?php
session_start();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Health</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../css/NewLoginStyle.css">
</head>
<body>
<div class="title">
    <h1>Monitoreo de salud</h1>
</div>
<div class="container">

    <form action="connStore.php" method="post" autocomplete="off" class="login">
        <div>
            <img class="doctor" src="../../img/doctor.png" alt="Doctores">
        </div>
        <section>
            <div class="credential">
                <label for="text">Nuevo usuario</label>
                <input type="text" name="user" value="<?= (!empty($_GET["user"])) ? $_GET["user"] : "" ?>">
                <label for="text">Facultad</label>
                <select class="selectCampus" name="campus" id="campus" style="max-width: 300px">
                    <?php
                    require_once("../../data/campus.php");
                    $campus = new Campus();
                    $data = $campus->facultades;
                    foreach ($data as $d) {
                        echo "<option value='" . $d . "'>" . $d . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="credential">
                <label for="password">Nueva contraseña</label>
                <input type="password" name="password" id="password">
                <label for="password">Confirmar contraseña</label>
                <input type="password" name="confirmPassword" id="confirmPassword">
            </div>
            <?php if (!empty($_GET['error'])): ?>
                <div id="alertError" class="alert alert-danger mb-2" role="alert">
                    <?= (!empty($_GET['error'])) ? $_GET['error'] : "" ?>
                </div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Crear</button>
        </section>

    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.selectCampus').select2({
            placeholder: "Seleccionar facultad...",
            allowClear: true
        });
    });
</script>
</body>
</html>