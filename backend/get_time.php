<?php
// Devuelve el valor del campo Time de la tabla de la base de datos y lo muestra en la tabla de la página principal
require_once 'classes/Database.php';

$database = new Database();
$conn = $database->conectar();

$query = "SELECT Time FROM actividad ORDER BY id DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
if ($result) {
    $Time = $result['Time'];
    echo "<td class='text-center'>$Time</td>";
} else {
    echo "<td class='text-center'>No disponible</td>";
}
// Cierra la conexión
$conn = null;
?>