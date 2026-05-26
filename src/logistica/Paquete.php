<?php
class Paquete{// Clase que representa un paquete en el sistema de logística
//Propiedades públicas para acceder a la información del paquete
    public string $codigoSeguimiento;
    public float $pesoKilogramos;
    public bool $esFragil;
//Propiedad privada para almacenar el costo interno del paquete, no accesible desde fuera de la clase    
    private float $costoInterno;
}
?>