<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema Luces Automáticas</title>
  <link rel="stylesheet" href="style/global.css">
</head>
<body>
  <nav>
    <h1>Sistema Luces Automáticas</h1>
  </nav>
  <main>
    <div class="content">
        <h2>Test de Conexión a BD (Envío de Datos)</h2>
            <form action="php/conexion.php" method="post">
                <label for="valor">Valor del sensor:</label><br>
                <input type="number" id="valor" name="valor" min="0" max="1" value="1"><br><br>
                <input type="submit" value="Enviar Datos">
            </form>
        <h2>Datos Registrados del Sensor</h2>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><h4>ID</h4></th>
                        <th><h4>Fecha</h4></th>
                        <th><h4>Hora</h4></th>
                        <th><h4>Valor (RAW)</h4></th>
                        <th><h4>Acción</h4></th>
                        <th><h4>Tiempo Total</h4></th>
                    </tr>
                </thead>
                <tbody id="data-table-body">
                    <tr><td colspan="6">Cargando datos...</td></tr>
                </tbody>
            </table>
        </div>
    </div>
  </main>
    <script src="js/main.js"></script>
</body>
</html>