<?php
namespace monitor_energetico\Calculo;

class IntegradorNumerico {
    private float $inicio; // Límite inferior (segundos)
    private float $fin;    // Límite superior (segundos)
    private int $pasos;    // Precisión (n subintervalos)
    private string $perfil;   // Perfil de consumo (IDLE, AVERAGE, STRESS)
    private float $factor_kwh = 2.7778E-7; // Factor de conversión de Joules a kWh

    public function __construct(float $a, float $b, string $perfil, int $n = 1000) {
        if ($a >= $b) {
            //Uso de \Exception porque estamos dentro de un namespace
            throw new \Exception("El tiempo inicial debe ser menor al final.");
        }
        if ($n <= 0 or $n > 1000000) {
            throw new \Exception("La precisión (n) debe ser un número positivo entre 1 y 1,000,000.");
        }
        $this->inicio = $a;
        $this->fin = $b;
        $this->perfil = $perfil;
        $this->pasos = $n;
    }

    public function convertirJoulesAkWh(float $joules): float {
        return $joules * $this->factor_kwh;
    }
    /**
     * Modela la función de potencia P(t) = t^2 + 2t (Ejemplo de carga creciente)
     * En informática, esto representaría los Watts consumidos.
     */
    private function funcionPotencia(float $t): float {
        switch ($this->perfil){
            case 'ORIGINAL':
                return pow($t, 2) + (2 * $t); // La fórmula requerida para el Punto 2
            case 'IDLE':
                return 5; // Consumo constante en reposo
            case 'AVERAGE':
                return (2*$t) + 5; // Consumo promedio con fluctuaciones
            case 'STRESS':
                return pow($t, 2); // Consumo creciente bajo estrés
            default:
            throw new \Exception("Perfil de consumo desconocido.");     // En caso de que llegue un valor inesperado que no sea ninguno de los 3
        }
    }

    public function calcularEnergiaTotal(): float {
        $h = ($this->fin - $this->inicio) / $this->pasos;
        $suma = ($this->funcionPotencia($this->inicio) + $this->funcionPotencia($this->fin)) / 2;
        
        for ($i = 1; $i < $this->pasos; $i++) {
            $t_i = $this->inicio + $i * $h;
            $suma += $this->funcionPotencia($t_i);
        }
        return $suma * $h;
    }
}