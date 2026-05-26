<?php
// Variables iniciales
$mensaje = '';
$archivo = 'bitacora.txt';

// Detectar si venimos de una redirección exitosa para mostrar el mensaje
if (isset($_GET['exito']) && $_GET['exito'] == 1) {
    $mensaje = "<p style='color: green; font-weight: bold;'>¡Actividad registrada con éxito!</p>";
}

// 2. Al enviar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar los datos
    $fecha = trim($_POST['fecha']);
    $descripcion = trim($_POST['descripcion']);
    $responsable = trim($_POST['responsable']);

    // 4. Validar que no se agreguen campos vacíos
    if (empty($fecha) || empty($descripcion) || empty($responsable)) {
        // 5. Mostrar mensajes de error
        $mensaje = "<p style='color: red; font-weight: bold;'>Error: Todos los campos son obligatorios.</p>";
    } else {
        // Formato requerido para guardar la actividad
        $registro = "Fecha: $fecha\nActividad: $descripcion\nResponsable: $responsable\n--------------------------\n";

        // Crear o abrir en modo append el archivo y guardar
        if (file_put_contents($archivo, $registro, FILE_APPEND | LOCK_EX)) {
            // SOLUCIÓN: Redirigir a la misma página por GET (Patrón PRG)
            // Agregamos ?exito=1 a la URL para saber que debemos mostrar el mensaje verde
            header("Location: " . $_SERVER['PHP_SELF'] . "?exito=1");
            exit; // Es muy importante usar exit después de un header para detener la ejecución
        } else {
            $mensaje = "<p style='color: red; font-weight: bold;'>Error al guardar en el archivo.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Bitácoras</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .contenedor { max-width: 600px; margin: auto; }
        form { background: #f4f4f4; padding: 15px; border-radius: 5px; }
        input[type="text"], input[type="date"] { width: 100%; padding: 8px; margin: 5px 0 15px 0; box-sizing: border-box; }
        input[type="submit"] { background: #333; color: white; padding: 10px 15px; border: none; cursor: pointer; }
        input[type="submit"]:hover { background: #555; }
        pre { background: #eee; padding: 10px; border: 1px solid #ccc; overflow-x: auto; }
    </style>
</head>
<body>

<div class="contenedor">
    <h2>Registrar Nueva Actividad</h2>
    
    <?php echo $mensaje; ?>

    <form method="POST" action="">
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>

        <label for="descripcion">Descripción de la actividad:</label>
        <input type="text" id="descripcion" name="descripcion" placeholder="Ej. Revisión de cámaras" required>

        <label for="responsable">Responsable:</label>
        <input type="text" id="responsable" name="responsable" placeholder="Ej. Juan Pérez" required>

        <input type="submit" value="Guardar Actividad">
    </form>

    <hr>

    <h2>Bitácora Diaria</h2>
    
    <?php
    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);
        echo "<pre>" . htmlspecialchars($contenido) . "</pre>";
    } else {
        echo "<p>El archivo bitacora.txt aún no ha sido creado. Registra una actividad primero.</p>";
    }
    ?>
</div>

</body>
</html>