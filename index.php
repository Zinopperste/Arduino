
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Luces</title>
  <link rel="stylesheet" href="css/global.css">
</head>
<body>
  <nav>
    <h1>Sistema Luces Automáticas</h1>
  </nav>
  <main>
    <div class="content">
        <table>
            <tr>
                <th><h4>Fecha</h4></th>
                <th><h4>Hora</h4></th>
                <th><h4>Accion</h4></th>
                <th><h4>Tiempo Total</h4></th>
            </tr>
            <tr>
                <?php
                // Aquí se muestran los datos obtenidos de la base de datos
                include 'backend/get_date.php';
                include 'backend/get_time.php';
                include 'backend/get_action.php';
                ?>
            </tr>
        </table>
    </div>
  </main>
</body>
</html>
