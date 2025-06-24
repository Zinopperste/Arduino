<?php
// Esta clase se encarga de conectar a la base de datos usando PDO
class Database {
    // Encapsulamiento: los datos sensibles de conexión se declaran como 'private' 
    // para protegerlos de accesos directos desde fuera de la clase.
    private $host = "localhost";      // Servidor
    private $dbname = "SistemaLuces";   // Nombre de la base de datos
    private $username = "root";       // Usuario (por defecto en XAMPP)
    private $password = "";           // Sin contraseña por defecto
    
    // La conexión se mantiene pública para que otras clases puedan usarla
    public $conn;

    // Método para establecer la conexión
    public function conectar() {
        $this->conn = null;

        try {
            // Se crea una nueva conexión PDO usando los datos privados encapsulados
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8",
                                  $this->username,
                                  $this->password);
        } catch (PDOException $e) {
            // Si hay error, se muestra (en un sistema real conviene manejarlo mejor)
            echo "Error de conexión: " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>