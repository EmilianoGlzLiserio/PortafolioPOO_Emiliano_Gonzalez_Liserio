<?php
// Verificamos que los datos realmente vengan del formulario por POST y existan los arreglos
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['productos']) && isset($_POST['precios'])) {
    
    $productos = $_POST['productos'];
    $precios = $_POST['precios'];
    
    // Cálculos
    $total_venta = array_sum($precios);
    $cantidad_productos = count($precios);
    
    // Evitamos división entre cero en caso de arreglos vacíos
    $promedio_precios = ($cantidad_productos > 0) ? ($total_venta / $cantidad_productos) : 0;
    
    $precio_maximo = max($precios);
    $indice_maximo = array_search($precio_maximo, $precios);
    $producto_mas_caro = $productos[$indice_maximo];
    
    $precio_minimo = min($precios);
    $indice_minimo = array_search($precio_minimo, $precios);
    $producto_mas_barato = $productos[$indice_minimo];
    
    // Si todo salió bien, incluimos la vista de resultados y DETENEMOS el resto de la ejecución
    include 'resultados.php';
    exit; 
    
} else {
    // Si no se envió el formulario correctamente, mostramos el error sin cargar las tablas
    echo "<h2>Error</h2>";
    echo "<p>Por favor, ingrese los datos desde el <a href='index.php'>formulario principal</a>.</p>";
}
?>