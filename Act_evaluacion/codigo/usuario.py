import re

# Clase base: Usuario
class Usuario:
    def __init__(self, nombre, email):
        self.nombre = nombre
        # Validación de email
        if not self._validar_email(email):
            raise ValueError(f"Email inválido: {email}")
        self.email = email

    def _validar_email(self, email):
        """Valida el formato del email con expresión regular."""
        patron = r'^[\w\.-]+@[\w\.-]+\.\w{2,}$'
        return re.match(patron, email) is not None

    def mostrar_datos(self):
        """Muestra los datos básicos del usuario."""
        print(f"  Nombre : {self.nombre}")
        print(f"  Email  : {self.email}")

    def acceso_sistema(self):
        """Define el nivel de acceso (se sobrescribe en clases hijas)."""
        print(f"  [{self.nombre}] Acceso genérico al sistema.")

    def saludar(self):
        """Método de saludo personalizado."""
        print(f"  ¡Hola, {self.nombre}! Bienvenido al sistema.")
