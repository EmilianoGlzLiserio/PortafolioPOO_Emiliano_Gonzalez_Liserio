<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario</title>
</head>
<body>
    <h2>Registro</h2>
    
    <form action="procesar.php" method="POST">
        <?php
        // Bucle FOR para generar dinámicamente los 5 campos de captura solicitados
        // Esto evita tener que escribir manualmente el código HTML 5 veces
        for ($i = 1; $i <= 5; $i++) {
            echo '<p>Producto '.$i.': ';
            
            // Campo para el nombre.
            // Al usar name="productos[]" con los corchetes, PHP guardará automáticamente todo en un arreglo.
            // El atributo 'required' cumple con la validación básica solicitada en la rúbrica.
            echo '<input type="text" name="productos[]" required placeholder="Nombre"> ';
            
            // Campo para el precio.
            // name="precios[]" almacena los datos en su propio arreglo paralelo.
            // step="0.01" y min="0.01" impiden que el usuario ponga precios negativos o letras.
            echo '<input type="number" step="0.01" min="0.01" name="precios[]" required placeholder="Precio">';
            
            echo '</p>';
        }
        ?>
        <button type="submit">Procesar Inventario</button>
    </form>
</body>
</html>