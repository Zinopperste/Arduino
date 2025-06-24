<?php
// Devuelve el valor de fecha de la tabla de la base de datos y lo muestra en la tabla de la página principal
require_once  'classes/Database.php';
$database = new Database();
$conn = $database->conectar();
$query = "SELECT Date FROM actividad ORDER BY id DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
if ($result) {
    $Date = $result['Date'];
    echo "<td class='text-center'>$Date</td>";
} else {
    echo "<td class='text-center'>No disponible</td>";
}
// Cierra la conexión
$conn = null;
?>