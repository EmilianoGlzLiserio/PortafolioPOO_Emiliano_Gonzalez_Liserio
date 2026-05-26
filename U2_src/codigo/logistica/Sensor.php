<?php
    class Sensor{// Clase que representa un sensor utilizado para monitorear las condiciones de los paquetes
    //Propiedades públicas para acceder a la información del sensor
        public int $id;
        public string $marca;
        public \DateTime $ultimaLectura;
        public float $rangoMaximo;
    }
?>