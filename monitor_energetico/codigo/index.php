<?php
require_once 'src/Calculo/IntegradorNumerico.php';

//El namespace correcto definido en la clase es monitor_energetico
use monitor_energetico\Calculo\IntegradorNumerico;

$resultado = null;
$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $integrador = new IntegradorNumerico(
            (float)$_POST['t_inicio'],
            (float)$_POST['t_fin'],
            (string)$_POST['perfil_consumo'],
            (int)$_POST['precision']
    
        );
        $resultado = $integrador->calcularEnergiaTotal();
        $resultado_kWh = $integrador->convertirJoulesAkWh($resultado); // Convertir Joules a kWh
    } catch (\Exception $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cloud Energy Monitor</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Monitor de Energía (DataCenter)</h1>
        <form method="POST">
            <label>Tiempo Inicial (s):</label>
            <input type="number" name="t_inicio" step="0.1" required>

            <label>Tiempo Final (s):</label>
            <input type="number" name="t_fin" step="0.1" required>

            <label>Precisión (n subintervalos):</label>
            <input type="number" name="precision" value="1000">

            <label>Perfil de Consumo:</label>
            <select name="perfil_consumo">
                <option value="ORIGINAL">ORIGINAL (Función Original)</option>
                <option value="IDLE">IDLE (Reposo)</option>
                <option value="AVERAGE">AVERAGE (Promedio)</option>
                <option value="STRESS">STRESS (Estrés)</option>
            </select>

            <button type="submit">Calcular Joules Consumidos</button>
        </form>

        <?php if ($resultado !== null): ?>
            <div class="result">
                <h2>Consumo Total:</h2>
                <h3><?php echo number_format($resultado, 4); ?> Joules</h3>
                <h3><?php echo number_format($resultado_kWh, 4); ?> kWh</h3>
                <p>Cálculo basado en la integral definida de la carga del servidor.</p>
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error"> Error: <?php echo $error; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
// Usamos el perfil ORIGINAL, intervalo de 0 a 10, y cambiamos solo la "n"
$calc10   = new IntegradorNumerico(0, 10, 'ORIGINAL', 10);
$res10    = $calc10->calcularEnergiaTotal();

$calc100  = new IntegradorNumerico(0, 10, 'ORIGINAL', 100);
$res100   = $calc100->calcularEnergiaTotal();

$calc1000 = new IntegradorNumerico(0, 10, 'ORIGINAL', 1000);
$res1000  = $calc1000->calcularEnergiaTotal();

$valorExacto = 433.33;
?>

<div class="container">
    <h2>Punto 2: Convergencia de la Integral (Fórmula Original)</h2>
    <p>Comparación del cálculo para el intervalo [0, 10] con P(t) = t² + 2t.</p>
    
    <table cellpadding="10" cellspacing="0" style="width: 100%; text-align: center;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Precisión (n)</th>
                <th>Resultado Calculado (Joules)</th>
                <th>Valor Real Exacto</th>
                <th>Margen de Error</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>10</td>
                <td><?php echo number_format($res10, 4); ?></td>
                <td><?php echo $valorExacto; ?></td>
                <td><?php echo number_format(abs($valorExacto - $res10), 4); ?></td>
            </tr>
            <tr>
                <td>100</td>
                <td><?php echo number_format($res100, 4); ?></td>
                <td><?php echo $valorExacto; ?></td>
                <td><?php echo number_format(abs($valorExacto - $res100), 4); ?></td>
            </tr>
            <tr style="background-color: #e6ffe6;">
                <td><strong>1000</strong></td>
                <td><strong><?php echo number_format($res1000, 4); ?></strong></td>
                <td><strong><?php echo $valorExacto; ?></strong></td>
                <td><strong><?php echo number_format(abs($valorExacto - $res1000), 4); ?></strong></td>
            </tr>
        </tbody>
    </table>
</div>