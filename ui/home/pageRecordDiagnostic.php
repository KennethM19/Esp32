<?php
    require_once '../../config/Sessions.php';
    require_once '../../config/Database.php';
    $db = new Database();
    $id = $_GET['dni'];
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>ESP32 WITH MYSQL DATABASE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/recordDiagnosticStyle.css">
</head>

<body>
<div class="topnav">
    <h3>ESP32 WITH MYSQL DATABASE</h3>
</div>

<br>

<h3 style="color: #0c6980;">ESP32_01 RECORD DATA TABLE</h3>

<table class="styled-table" id= "table_id">
    <thead>
    <tr>
        <th>TEMPERATURA (°C)</th>
        <th>RITMO CARDIACO</th>
        <th>OXÍGENO</th>
        <th>FECHA (dd-mm-yyyy)</th>
    </tr>
    </thead>
    <tbody id="tbody_table_record">
    <?php
    $num = 0;

    $pdo = $db->connect();
    $statement = $pdo->prepare("SELECT id FROM patient_student where docNum = :id");
    $statement->bindParam(':id', $id);
    $statement->execute();
    $result = $statement->fetch();
    $id = $result['id'];

    $sql = "SELECT * FROM diagnostic WHERE id_student = '$id'";
    foreach ($pdo->query($sql) as $row) {
        echo '<tr>';
        echo '<td class="bdr">'. $row['temperature'] . '</td>';
        echo '<td class="bdr">'. $row['heartbeat'] . '</td>';
        echo '<td class="bdr">'. $row['oxygen_blood'] . '</td>';
        echo '<td class="bdr">'. $row['date'] . '</td>';
        echo '</tr>';
    }
    //------------------------------------------------------------
    ?>
    </tbody>
</table>

<br>

<div class="btn-group">
    <button class="button" id="btn_prev" onclick="prevPage()">Prev</button>
    <button class="button" id="btn_next" onclick="nextPage()">Next</button>
    <div style="display: inline-block; position:relative; border: 0px solid #e3e3e3; float: center; margin-left: 2px;;">
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
    //------------------------------------------------------------
    var current_page = 1;
    var records_per_page = 10;
    var l = document.getElementById("table_id").rows.length
    //------------------------------------------------------------

    //------------------------------------------------------------
    function apply_Number_of_Rows() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);
    }
    //------------------------------------------------------------

    //------------------------------------------------------------
    function prevPage() {
        if (current_page > 1) {
            current_page--;
            changePage(current_page);
        }
    }
    //------------------------------------------------------------

    //------------------------------------------------------------
    function nextPage() {
        if (current_page < numPages()) {
            current_page++;
            changePage(current_page);
        }
    }
    //------------------------------------------------------------

    //------------------------------------------------------------
    function changePage(page) {
        var btn_next = document.getElementById("btn_next");
        var btn_prev = document.getElementById("btn_prev");
        var listing_table = document.getElementById("table_id");
        var page_span = document.getElementById("page");

        // Validate page
        if (page < 1) page = 1;
        if (page > numPages()) page = numPages();

        [...listing_table.getElementsByTagName('tr')].forEach((tr)=>{
            tr.style.display='none'; // reset all to not display
        });
        listing_table.rows[0].style.display = ""; // display the title row

        for (var i = (page-1) * records_per_page + 1; i < (page * records_per_page) + 1; i++) {
            if (listing_table.rows[i]) {
                listing_table.rows[i].style.display = ""
            } else {
                continue;
            }
        }

        page_span.innerHTML = page + "/" + numPages() + " (Total Number of Rows = " + (l-1) + ") | Number of Rows : ";

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
    //------------------------------------------------------------

    //------------------------------------------------------------
    function numPages() {
        return Math.ceil((l - 1) / records_per_page);
    }
    //------------------------------------------------------------

    //------------------------------------------------------------
    window.onload = function() {
        var x = document.getElementById("number_of_rows").value;
        records_per_page = x;
        changePage(current_page);
    };
    //------------------------------------------------------------
</script>
</body>
</html>
