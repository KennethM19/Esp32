<?php
require_once('../../config/Sessions.php');
if (empty($_SESSION['user'])) {
    header('location: pageIndex.php');
    exit();
} else if ($_SESSION['user'] != 'admin') {
    header('location: pageRecordPatient.php');
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Health</title>
    <link rel="stylesheet" href="../css/PageIndexAdminStyle.css">
</head>
<body>
    <div class="navbar">
        <a href="connLogout.php">Cerrar sesión</a>
    </div>
    <div class="body-page">
        <section>
            <div class="tittle">
                <h1>REGISTRO DE SALUD</h1>
            </div>
            <div class="button-list">
                <a href="pageRecordPatient.php">
                     Pacientes externos
                </a>
            </div>
            <div class="campus-list">
                <div class="campus-tittle">
                    <h1>Facultades</h1>
                </div>
                <ul>
                    <?php
                    require_once '../../data/campus.php';
                    $campus = new Campus();
                    $data = $campus ->facultades;
                    foreach ($data as $d) {
                        echo "<li value='" . $d . "'><a href='pageRecordPatient.php'>" . $d . "</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </section>
    </div>
</body>
</html>