<?php
require_once('../../config/Sessions.php');
require_once('../../model/HomeModel.php');
if (empty($_SESSION['user'])) {
    header('location: pageIndex.php');
    exit();
}
$model = new HomeModel();
$idCampus = $model->getIdCampus2($_SESSION['user']);
$patients = $model->getPatients($idCampus);
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>ESP32 WITH MYSQL DATABASE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/RecordPatientStyle.css">
</head>

<body>
<div class="topnav">
    <h3>HEALTH MANAGEMENT</h3>
    <a href="connLogout.php" class="button">Cerrar Sesión</a>
    <?php if ($_SESSION['user'] == 'admin'): ?>
        <a href="pageNewLogin.php" class="button">Crear</a>
    <?php endif; ?>
</div>

<br>

<h3 style="color: #0c6980;">PACIENTES</h3>


<section class="container">
    <div class="managPatient">
        <a href="pagePatient.php" class="button">Nuevo</a>
        <input type="text" placeholder="Buscar paciente" id="campo" name="campo" onkeyup="searchPatient()" autocomplete="false">
    </div>
    <table class="styled-table" id="table_id">
        <thead>
        <tr>
            <th>DOCUMENTO</th>
            <th>NÚMERO</th>
            <th>NOMBRE</th>
            <th>APELLIDO</th>
            <th>GÉNERO</th>
        </tr>
        </thead>
        <tbody id="record_patient">
        <?php if ($patients): ?>
            <?php
            foreach ($patients as $patient):
                ?>
                <?php echo '<tr onclick="redirectPatient(' . $patient['docNum'] . ',\'' . $patient['name'] . '\')">' ?>
                <td><?php echo htmlspecialchars($patient['docType']) ?></td>
                <td><?php echo htmlspecialchars($patient['docNum']) ?></td>
                <td><?php echo htmlspecialchars($patient['name']) ?></td>
                <td><?php echo htmlspecialchars($patient['lastname']) ?></td>
                <td><?php echo htmlspecialchars($patient['gender']) ?></td>
                <?php echo '</tr>' ?>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5"></td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>

</section>
<br>

<div class="btn-group">
    <button class="button" id="btn_prev" onclick="prevPage()">Prev</button>
    <button class="button" id="btn_next" onclick="nextPage()">Next</button>
    <div style="display: inline-block; position:relative; border: 0 solid #e3e3e3; float: center; margin-left: 2px;">
        <p style="position:relative; font-size: 14px;"> Table : <span id="page"></span></p>
    </div>
    <select name="number_of_rows" id="number_of_rows">
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
    <button class="button" id="btn_apply" onclick="apply_Number_of_Rows()">Apply</button>
</div>

<br>

<script>

    let current_page = 1;
    let records_per_page = 10;
    let l = document.getElementById("table_id").rows.length;

    function apply_Number_of_Rows() {
        records_per_page = document.getElementById("number_of_rows").value;
        changePage(current_page);
    }


    function prevPage() {
        if (current_page > 1) {
            current_page--;
            changePage(current_page);
        }
    }


    function nextPage() {
        if (current_page < numPages()) {
            current_page++;
            changePage(current_page);
        }
    }


    function changePage(page) {
        const btn_next = document.getElementById("btn_next");
        const btn_prev = document.getElementById("btn_prev");
        const listing_table = document.getElementById("table_id");
        const page_span = document.getElementById("page");

        // Validate page
        if (page < 1) page = 1;
        if (page > numPages()) page = numPages();

        [...listing_table.getElementsByTagName('tr')].forEach((tr) => {
            tr.style.display = 'none'; // reset all to not display
        });
        listing_table.rows[0].style.display = ""; // display the title row

        for (let i = (page - 1) * records_per_page + 1; i < (page * records_per_page) + 1; i++) {
            if (listing_table.rows[i]) {
                listing_table.rows[i].style.display = ""
            } else {

            }
        }

        page_span.innerHTML = page + "/" + numPages() + " (Total Number of Rows = " + (l - 1) + ") | Number of Rows : ";

        if (page === 0 && numPages() === 0) {
            btn_prev.disabled = true;
            btn_next.disabled = true;
            return;
        }

        btn_prev.disabled = page === 1;

        btn_next.disabled = page === numPages();
    }


    function numPages() {
        return Math.ceil((l - 1) / records_per_page);
    }


    window.onload = function () {
        records_per_page = document.getElementById("number_of_rows").value;
        changePage(current_page);
    };

    function searchPatient() {
        let input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("campo");
        filter = input.value.toLowerCase();
        table = document.getElementById("table_id");
        tr = table.getElementsByTagName("tr");

        for (i = 1; i < tr.length; i++) {
            tr[i].style.display = "none";
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    }
                }
            }
        }
    }

    function redirectPatient(dni, name) {
        window.location.href = 'Home.php?dni=' + dni + '&name=' + name;
    }
</script>
</body>
</html>