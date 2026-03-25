# Mini sistema para centros educativos
Mini sistema hecho en CodeIgniter 2.2 para llevar el control de los alumnos, docentes, cursos, grados, notas y asistencias de un centro educativo.

> [!WARNING]   
> Este proyecto se desarrollo en el año 2014-2015 para un proyecto de la universidad por lo que carece de muchas medidas de seguridad, por ejemplo las contraseñas se guardan en texto plano en la base de datos. USARLO BAJO RIESGO PROPIO.

## Requerimientos
* PHP >= 5.1.6 y PHP <= 7.4
* MySQL >= 5.7
* Nginx o Apache

## Configuración
### Base de datos
1. Cargar el archivo [sis-escuela-backup.sql](sis-escuela-backup.sql) en la base de datos
```bash
mysql -u <user> -p < sis-escuela-backup.sql
```
Al cargar este archivo se creara una nueva base de datos llamada sis_escuela y en esta se encontrarán todas las tablas y datos necesarios para el sistema.
### Servidor web y PHP
1. Copiar todos los archivos a la raíz o una subcarpeta del servidor web
1. Se debe configurar la URL base del sistema en el archivo [application/config/config.php](application/config/config.php) 
```php
// Colocar la url donde se alojará el sistema. Si los archivos estan en una subcarpeta colocar el nombre en la URL. Ej. http://localhost/sis-escuela
$config['base_url']	= 'http://localhost';
```
2. Configurar las credenciales de la base de datos en el archivo [application/config/database.php](application/config/database.php)
```php
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'sis_escuela';
```
### Credenciales de prueba
Usar estas credenciales para ingresar al sistema  
| Rol | Usuario | Contraseña |
|---- |---------|------------|
| Administrador| admin | admin |
| Docente | ccifuentes | admin |
