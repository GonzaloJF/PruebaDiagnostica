para comenzar necesitamos tener instalado lo siguiente:

php version: 8.5.6
postgres version: 18

Lo primero que haremos es correr el script de la base de datos de los siguientes pasos: 
Linux: 
psql -U postgres ó [nombre de usuario que se ocupe en la base de datos]

\i 'direccion donde esta el archivo database.sql' ejemplo (/home/User/pruebaDiagnostica/database.sql)

y luego verificamos las tablas con un \dt ó podemos hacer SELECT * FROM ['nombre tablas'];

en windows:
podemos realizar lo mismo 
psql -U postgres ó [nombre de usuario que se ocupe en la base de datos]

\i 'direccion donde esta el archivo database.sql' ejemplo (D:/programas/pruebaDiagnostica/database.sql)

podemos verificar las tablas con \dtó podemos hacer SELECT * FROM ['nombre tablas'];

Luego de eso podemos verificar las credenciales en el backend/conexion.php

dentro de la clase tenemos los siguientes datos: 
    $host = "localhost";
    $dbname = "prueba";
    $username = "nombre de usuario";
    $password = "su contraseña";

Ahora tenemos que levantar el servidor php dentro de la carpeta del proyecto con el siguiente comando: 

php -S localhost:8000

y ya deberiamos poder probar la plataforma.

