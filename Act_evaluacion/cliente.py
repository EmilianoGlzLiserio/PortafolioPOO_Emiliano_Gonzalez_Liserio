from usuario import Usuario

# Clase derivada: Cliente (hereda de Usuario)
class Cliente(Usuario):
    PUNTOS_MIN = 0
    PUNTOS_MAX = 100_000

    def __init__(self, nombre, email, puntos=0):
        super().__init__(nombre, email)       # Llama al constructor de Usuario
        self.puntos = self._validar_puntos(puntos)  # Valida y asigna

    def _validar_puntos(self, puntos):
        """Valida que puntos sea un entero no negativo dentro del límite permitido."""
        try:
            puntos_int = int(puntos)
        except (ValueError, TypeError):
            raise ValueError(
                f"Puntos inválidos: '{puntos}'. "
                f"Deben ser un número entero, no texto."
            )
        if puntos_int < self.PUNTOS_MIN:
            raise ValueError(
                f"Los puntos no pueden ser negativos: {puntos_int}."
            )
        if puntos_int > self.PUNTOS_MAX:
            raise ValueError(
                f"Puntos fuera de rango: {puntos_int}. "
                f"El máximo permitido es {self.PUNTOS_MAX:,}."
            )
        return puntos_int

    def mostrar_datos(self):
        """Muestra datos del cliente incluyendo sus puntos acumulados."""
        super().mostrar_datos()
        print(f"  Puntos acumulados: {self.puntos}")

    def acceso_sistema(self):
        """Sobrescritura: acceso limitado al catálogo y perfil."""
        print(f"  [{self.nombre}] CLIENTE — Acceso al catálogo y perfil personal. Puntos: {self.puntos}")

    def canjear_puntos(self, cantidad):
        """Método exclusivo del cliente."""
        if cantidad <= self.puntos:
            self.puntos -= cantidad
            print(f"  [{self.nombre}] Canjeaste {cantidad} puntos. Saldo restante: {self.puntos}")
        else:
            print(f"  [{self.nombre}] No tienes suficientes puntos.")