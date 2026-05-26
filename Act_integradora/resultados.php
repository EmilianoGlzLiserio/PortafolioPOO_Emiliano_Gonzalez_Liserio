<?php
// CANDADO DE SEGURIDAD: 
// Si la variable $total_venta no existe, significa que intentaron abrir este archivo directamente.
// En ese caso, detenemos la página inmediatamente usando die() para evitar los Warnings.
if (!isset($total_venta)) {
    die("<h2>Acceso Denegado</h2><p>No se encontraron datos. Por favor, llena la información en el <a href='index.php'>formulario principal</a>.</p>");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados del Inventario</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 50%; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Resumen de Inventario</h2>
    
    <table>
        <tr>
            <th>Métrica Calculada</th>
            <th>Resultado</th>
        </tr>
        <tr>
            <td>Precio total de todos los productos</td>
            <td>$<?php echo number_format($total_venta, 2); ?></td>
        </tr>
        <tr>
            <td>Promedio de precios</td>
            <td>$<?php echo number_format($promedio_precios, 2); ?></td>
        </tr>
        <tr>
            <td>Producto más caro</td>
            <td><?php echo htmlspecialchars($producto_mas_caro); ?> (Precio: $<?php echo number_format($precio_maximo, 2); ?>)</td>
        </tr>
        <tr>
            <td>Producto más barato</td>
            <td><?php echo htmlspecialchars($producto_mas_barato); ?> (Precio: $<?php echo number_format($precio_minimo, 2); ?>)</td>
        </tr>
    </table>

    <h3>Detalle de Productos Ingresados</h3>
    
    <table>
        <tr>
            <th>Nombre del Producto</th>
            <th>Precio</th>
        </tr>
        <?php
        // Utilizamos un ciclo FOR para recorrer los arreglos paralelos
        // $i comienza en 0 (primer elemento) y avanza hasta el total de productos capturados
        for ($i = 0; $i < $cantidad_productos; $i++) {
            echo "<tr>";
            // Imprimimos el nombre del producto almacenado en el índice actual ($i)
            echo "<td>" . htmlspecialchars($productos[$i]) . "</td>";
            // Imprimimos el precio del producto almacenado en el mismo índice ($i)
            echo "<td>$" . number_format($precios[$i], 2) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    
    <br>
    <a href="index.php"><button>Registrar Nuevos Productos</button></a>
</body>
</html>