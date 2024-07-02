<?php
require_once ("D:\UNMSM\IHC\ESP32\config\connESP32.php");
header('Content-Type: application/json');

// Crear instancia de la clase Database
$database = new connESP32();
$db = $database->connect();

$statement = $db->prepare("SELECT * FROM sensors ORDER BY id DESC LIMIT 1");  // Ajusta la consulta según tu base de datos
$statement->execute();
$result = $statement->fetch(PDO::FETCH_ASSOC);

// Devolver los datos en formato JSON
echo json_encode([
    'temperature' => $result['temperature'],
    'heartbeat' => $result['heartbeat'],
    'oxygen' => $result['oxygen'],
]);
