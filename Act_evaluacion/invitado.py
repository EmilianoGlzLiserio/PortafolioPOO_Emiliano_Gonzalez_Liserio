from usuario import Usuario

# Clase derivada: Invitado (hereda de Usuario)
class Invitado(Usuario):
    def __init__(self, nombre, email):
        super().__init__(nombre, email)       # Llama al constructor de Usuario

    def acceso_sistema(self):
        """Sobrescritura: acceso mínimo, solo lectura pública."""
        print(f"  [{self.nombre}] INVITADO — Solo lectura. Acceso limitado a contenido público.")
