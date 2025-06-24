<?php
// Establece el encabezado Content-Type para indicar que la respuesta será JSON.
header("Content-Type: application/json");

// Sección de Configuración de la Base de Datos
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "smart_lights";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión falló
if ($conn->connect_error) {
    die(json_encode(["error" => "Conexión fallida: " . $conn->connect_error]));
}

$sql = "SELECT id, date, time, value FROM light_1 ORDER BY date DESC, time DESC";
$result = $conn->query($sql);

$data = [];

// Verifica si la consulta se ejecutó con éxito y si hay resultados
if ($result) { // (si la consulta falló)
    if ($result->num_rows > 0) {
        // Recorre cada fila de resultados y añade al array $data
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        // Devuelve los datos en formato JSON
        echo json_encode($data);
    } else {
        // Si no hay filas, devolver un mensaje JSON indicando que no hay datos.
        echo json_encode(["mensaje" => "No hay datos disponibles"]);
    }
} else {
    // Si la consulta SQL falló (ej. nombre de tabla incorrecto.)
    echo json_encode(["error" => "Error en la consulta SQL: " . $conn->error]);
}

$conn->close();
?>