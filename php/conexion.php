<?php
// Establece el encabezado Content-Type para indicar que la respuesta será JSON.
header("Content-Type: application/json");

// Función auxiliar para enviar una respuesta JSON y terminar la ejecución del script
function sendJsonResponse($status, $message) {
    echo json_encode(["status" => $status, "message" => $message]);
    exit();
}

// Sección de Configuración de la Base de Datos
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "smart_lights";

// Crear la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si la conexión falló
if ($conn->connect_error) {
    // die("Conexión fallida: " . $conn->connect_error);
    sendJsonResponse("error", "Conexión fallida con la base de datos.");
}

// Espera que Arduino envíe datos a través de una solicitud POST.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar si el índice 'valor' existe en los datos POST
    if (isset($_POST["valor"])) {
        // Capturar el valor enviado por Arduino
        $valor = $_POST["valor"];
        $valor_int = (int)$valor; // Asegúra de que el valor sea un entero y esté dentro del rango y convierte a entero
        
        // Opcional: Validación de rango si tu 'value' en MySQL es UNSIGNED TINYINT (0-255)
        if ($valor_int < 0 || $valor_int > 1) {
            sendJsonResponse("error", "El valor del sensor (" . $valor_int . ") está fuera del rango permitido (0-1).");
            // No se inserta nada, se cierra la conexión y se sale.
            $conn->close();
            exit();
        }

        // Utilizamos sentencias preparadas para prevenir la inyección SQL.
        // Las columnas son 'date', 'time' y 'value'.
        $sql = "INSERT INTO light_1 (date, time, value) VALUES (CURDATE(), CURTIME(), ?)";

        // Prepara la declaración
        $stmt = $conn->prepare($sql);

        // Verifica si la preparación de la declaración falló
        if ($stmt === FALSE) {
            //echo "Error al preparar la consulta: " . $conn->error;
            sendJsonResponse("error", "Error al preparar la consulta SQL.");
        } else {
            // Vincular los parámetros
            // 'i' indica que el parámetro es de tipo entero (integer).
            // Esto coincide con el tipo TINYINT de tu columna 'value'.
            $stmt->bind_param("i", $valor_int);

            // Ejecuta la declaración
            if ($stmt->execute()) {
                //echo "Datos insertados correctamente";
                sendJsonResponse("success", "Datos insertados correctamente.");
            } else {
                //echo "Error al insertar datos: " . $stmt->error;
                sendJsonResponse("error", "Error al insertar datos: " . $stmt->error);
            }

            // Cerrar la declaración preparada
            $stmt->close();
        }
    } else {
        // Si no se recibió el parámetro 'valor' en la solicitud POST
        //echo "Error: No se recibió el parámetro 'valor' en la solicitud POST.";
        sendJsonResponse("error", "No se recibió el parámetro 'valor' en la solicitud POST.");
    }
} else {
    // Si la solicitud no es POST (ej. alguien intenta acceder directamente desde el navegador)
    //echo "Esta página solo acepta solicitudes POST para insertar datos.";
    sendJsonResponse("error", "Esta página solo acepta solicitudes POST.");
}

// Es buena práctica cerrar la conexión una vez que todas las operaciones de DB han terminado.
$conn->close();
?>