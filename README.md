# PROYECTOWEB - PHP + MySQL + AlwaysData

## Archivo principal
- `index.php`: página principal de Ideas Madera.
- `envios.php`: formulario y listado de envíos conectado a MySQL.
- `guardar_envio.php`: guarda los envíos mediante POST.
- `conexion.php`: conexión a MySQL y creación automática de la tabla `envios`.

## Base de datos
La conexión está configurada para AlwaysData en `conexion.php`.

Por seguridad, si las credenciales cambian en AlwaysData, modifica únicamente:
- servidor
- usuario
- contraseña
- nombre de la base de datos

## Tabla
`envios`:
- id
- nombre
- correo
- telefono
- destinatario
- fecha_registro

## Instalación en AlwaysData
1. Sube todos los archivos y carpetas del proyecto a tu espacio web.
2. Verifica que `index.php` quede en la carpeta pública de tu sitio.
3. Verifica las credenciales de MySQL en `conexion.php`.
4. Abre `envios.php`.
5. Registra un envío. La tabla se crea automáticamente si no existe.

No se usa `CREATE DATABASE` desde PHP porque en hosting administrado la base de datos normalmente ya existe.
