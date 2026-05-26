from usuario import Usuario

# Clase derivada: Admin (hereda de Usuario)
class Admin(Usuario):
    NIVEL_MIN = 1
    NIVEL_MAX = 5

    def __init__(self, nombre, email, nivel_acceso):
        super().__init__(nombre, email)       # Llama al constructor de Usuario
        self.nivel_acceso = self._validar_nivel(nivel_acceso)  # Valida y asigna

    def _validar_nivel(self, nivel):
        """Valida que nivel_acceso sea un entero entre NIVEL_MIN y NIVEL_MAX."""
        try:
            nivel_int = int(nivel)
        except (ValueError, TypeError):
            raise ValueError(
                f"Nivel de acceso inválido: '{nivel}'. "
                f"Debe ser un número entero, no texto."
            )
        if not (self.NIVEL_MIN <= nivel_int <= self.NIVEL_MAX):
            raise ValueError(
                f"Nivel de acceso fuera de rango: {nivel_int}. "
                f"El valor debe estar entre {self.NIVEL_MIN} y {self.NIVEL_MAX}."
            )
        return nivel_int

    def mostrar_datos(self):
        """Muestra datos del admin incluyendo su nivel de acceso."""
        super().mostrar_datos()
        print(f"  Nivel de acceso: {self.nivel_acceso}")

    def acceso_sistema(self):
        """Sobrescritura: acceso total al sistema."""
        print(f"  [{self.nombre}] ADMINISTRADOR — Acceso TOTAL. Nivel: {self.nivel_acceso}")

    def gestionar_usuarios(self):
        """Método exclusivo del administrador."""
        print(f"  [{self.nombre}] Gestionando usuarios del sistema...")