<?php
require_once("D:\UNMSM\IHC\ESP32\config\Database.php");
header('Content-Type: application/json');

$database = new dataBase();
$db = $database->connect();

$statement = $db->prepare("SELECT * FROM `diagnostic_test` ORDER BY id DESC LIMIT 1");
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $data = [
        'temperature' => $result['temperature'],
        'heartbeat' => $result['heartbeat'],
        'oxygen' => $result['oxygen_blood']
    ];
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'No data found']);
}