<?php
require_once('../../config/Sessions.php');
require_once('../../model/HomeModel.php');
if (empty($_SESSION['user'])) {
    header('location: Index.php');
}
$model = new HomeModel();
$patients = $model->getPatients();
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>ESP32 WITH MYSQL DATABASE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../asset/css/RecordPatientStyle.css">
</head>

<body>
<div class="topnav">
    <h3>HEALTH MANAGEMENT</h3>
    <a href="Logout.php" class="button">Cerrar Sesión</a>
</div>

<br>

<h3 style="color: #0c6980;">PACIENTES</h3>


<section class="container">
    <div class="managPatient">
        <a href="Patient.php" class="button">Nuevo</a>
        <input type="text" placeholder="Buscar paciente">
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
                <tr>
                    <td><?php echo htmlspecialchars($patient['docType']) ?></td>
                    <td><?php echo htmlspecialchars($patient['docNum']) ?></td>
                    <td><?php echo htmlspecialchars($patient['name']) ?></td>
                    <td><?php echo htmlspecialchars($patient['lastname']) ?></td>
                    <td><?php echo htmlspecialchars($patient['gender']) ?></td>
                </tr>
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
    <div style="display: inline-block; position:relative; border: 0px solid #e3e3e3; float: center; margin-left: 2px;">
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

    var current_page = 1;
    var records_per_page = 10;
    var l = document.getElementById("table_id").rows.length

    function apply_Number_of_Rows() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
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
        var btn_next = document.getElementById("btn_next");
        var btn_prev = document.getElementById("btn_prev");
        var listing_table = document.getElementById("table_id");
        var page_span = document.getElementById("page");

        // Validate page
        if (page < 1) page = 1;
        if (page > numPages()) page = numPages();

        [...listing_table.getElementsByTagName('tr')].forEach((tr) => {
            tr.style.display = 'none'; // reset all to not display
        });
        listing_table.rows[0].style.display = ""; // display the title row

        for (var i = (page - 1) * records_per_page + 1; i < (page * records_per_page) + 1; i++) {
            if (listing_table.rows[i]) {
                listing_table.rows[i].style.display = ""
            } else {
                continue;
            }
        }

        page_span.innerHTML = page + "/" + numPages() + " (Total Number of Rows = " + (l - 1) + ") | Number of Rows : ";

        if (page == 0 && numPages() == 0) {
            btn_prev.disabled = true;
            btn_next.disabled = true;
            return;
        }

        if (page == 1) {
            btn_prev.disabled = true;
        } else {
            btn_prev.disabled = false;
        }

        if (page == numPages()) {
            btn_next.disabled = true;
        } else {
            btn_next.disabled = false;
        }
    }


    function numPages() {
        return Math.ceil((l - 1) / records_per_page);
    }


    window.onload = function () {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);
    };
    //------------------------------------------------------------
</script>
</body>
</html>

