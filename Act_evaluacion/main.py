from usuario import Usuario
from admin import Admin
from cliente import Cliente
from invitado import Invitado

# ──────────────────────────────────────────────
#  Lista global de usuarios del sistema
# ──────────────────────────────────────────────
usuarios = []

def registrar_usuario(usuario):
    """Agrega un usuario a la lista del sistema."""
    usuarios.append(usuario)

def mostrar_todos():
    """Recorre la lista y muestra datos + acceso (polimorfismo)."""
    print("\n" + "═"*50)
    print("   LISTADO DE USUARIOS DEL SISTEMA")
    print("═"*50)
    for i, u in enumerate(usuarios, 1):
        print(f"\n► Usuario #{i}  ({type(u).__name__})")
        u.saludar()
        u.mostrar_datos()
        u.acceso_sistema()
    print("═"*50)

def menu():
    """Menú interactivo principal."""
    while True:
        print("\n╔══════════════════════════════╗")
        print("║   SISTEMA DE USUARIOS v1.0   ║")
        print("╠══════════════════════════════╣")
        print("║ 1. Mostrar todos los usuarios║")
        print("║ 2. Agregar Administrador     ║")
        print("║ 3. Agregar Cliente           ║")
        print("║ 4. Agregar Invitado          ║")
        print("║ 5. Salir                     ║")
        print("╚══════════════════════════════╝")
        opcion = input("  Elige una opción: ").strip()

        if opcion == "1":
            mostrar_todos()

        elif opcion == "2":
            nombre = input("  Nombre del admin: ")
            email  = input("  Email: ")
            nivel  = input("  Nivel de acceso (1-5): ")
            try:
                a = Admin(nombre, email, nivel)
                registrar_usuario(a)
                print(f"  ✔ Admin '{nombre}' registrado.")
            except ValueError as e:
                print(f"  ✖ Error: {e}")

        elif opcion == "3":
            nombre = input("  Nombre del cliente: ")
            email  = input("  Email: ")
            pts    = input("  Puntos iniciales (0): ") or "0"
            try:
                c = Cliente(nombre, email, pts)   # el constructor valida internamente
                registrar_usuario(c)
                print(f"  ✔ Cliente '{nombre}' registrado.")
            except ValueError as e:
                print(f"  ✖ Error: {e}")

        elif opcion == "4":
            nombre = input("  Nombre del invitado: ")
            email  = input("  Email: ")
            try:
                inv = Invitado(nombre, email)
                registrar_usuario(inv)
                print(f"  ✔ Invitado '{nombre}' registrado.")
            except ValueError as e:
                print(f"  ✖ Error: {e}")

        elif opcion == "5":
            print("\n  Cerrando sistema. ¡Hasta pronto!\n")
            break
        else:
            print("  Opción no válida. Intenta de nuevo.")

# ──────────────────────────────────────────────
#  PROGRAMA PRINCIPAL
# ──────────────────────────────────────────────
if __name__ == "__main__":
    # Crear usuarios predefinidos (mínimo 1 admin, 1 cliente, 1 invitado)
    registrar_usuario(Admin("Carlos Ramírez",  "carlos@admin.com",  5))
    registrar_usuario(Cliente("Ana Torres",    "ana@cliente.com",   350))
    registrar_usuario(Invitado("Luis Gómez",   "luis@correo.com"))

    # Mostrar datos iniciales con polimorfismo
    mostrar_todos()

    # Lanzar menú interactivo
    menu()