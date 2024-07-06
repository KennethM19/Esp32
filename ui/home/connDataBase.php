<?php
require_once("../../config/Database.php");
header('Content-Type: application/json');

$response = [];
$database = new Database();
$db = $database->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST["dni"];
    $temperature = $_POST["temperature"];
    $heartbeat = $_POST["heartbeat"];
    $oxygen = $_POST["oxygen"];
}

$statement = $db->prepare("SELECT id FROM patient_student WHERE docNum = :dni");
$statement->bindParam(":dni", $dni);
$statement->execute();
if ($statement->execute()) {
    $result = $statement->fetch();

    $id = $result["id"];

    $statement = $db->prepare("INSERT INTO diagnostic (id_student, temperature, heartbeat, oxygen_blood, date) VALUES (:id, :temperature, :heartbeat, :oxygen, NOW())");
    $statement->bindParam(":id", $id);
    $statement->bindParam(":temperature", $temperature);
    $statement->bindParam(":heartbeat", $heartbeat);
    $statement->bindParam(":oxygen", $oxygen);

    if ($statement->execute()) {
        $response["status"] = "success";
        $response["message"] = "Datos insertados correctamente";
    } else {
        $response["status"] = "Error";
        $response["message"] = "Error:" . $statement->errorInfo();
    }
} else {
    $response["status"] = "Error";
    $response["message"] = "Error:" . $statement->errorInfo();
}
echo json_encode($response);
