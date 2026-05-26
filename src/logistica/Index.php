<?php
//importamos las clases necesarias para trabajar con paquetes y sensores
require_once 'Sensor.php';
require_once 'Paquete.php';
// Creamos instancias de la clase Paquete y asignamos valores a sus propiedades
$paqueteA = new Paquete();
$paqueteB = new Paquete();
$paqueteA->codigoSeguimiento = 'ABC123';
$paqueteA->pesoKilogramos = 2.5;
$paqueteA->esFragil = true;
// Intentamos acceder a la propiedad privada $costoInterno, lo que causará un error
$paqueteA->costoInterno = 50.0; // Esto causará un error porque $costoInterno es privado para ser presisos este error es el que sale 
// "Fatal error: Uncaught Error: Cannot access private property Paquete::$costoInterno in C:\xampp\htdocs\src\logistica\Index.php:9 Stack trace: #0 {main} thrown in 
// C:\xampp\htdocs\src\logistica\Index.php on line 9"
$sensor1 = new Sensor();// Creamos una instancia de la clase Sensor 
$sensor1->ultimaLectura = new \DateTime('2024-06-01 10:00:00');// Asignamos una fecha y hora a la propiedad ultimaLectura del sensor
// Imprimimos información sobre el paquete y el sensor utilizando las propiedades públicas
echo "Código de seguimiento del paquete A: " . $paqueteA->codigoSeguimiento . "\n";
echo "Peso del paquete A: " . $paqueteA->pesoKilogramos . " kg\n";
echo "¿El paquete A es frágil? " . ($paqueteA->esFragil ? 'Sí' : 'No') . "\n";
echo "Última lectura del sensor: " . $sensor1->ultimaLectura->format('Y-m-d H:i:s') . "\n"; 
?>