Requirimientos de aplicación:

    Las pruebas se han realizado sobre Symfony 5 bajo php 7.2 con mysql-server, esto require tener instalado PHP 7.2 y MYSQL-server en su última version, así como composer en tu sistema.
    Requiere tener instaladas las dependencias phpunit.

Instalación:

Clonarse el repositorio de github:

    Instalar dependencias de proyectos necesarias en el directorio raiz de la carpeta del proyecto realizando:
    composer install
    (esto instalará las dependencias necesarias de symfony para el proyecto)

Configurar la base de datos de nuestro proyecto:

    Cuando esten las dependencias de Symfony instaladas, lo primero que haremos sera configurar la base de datos.
    Dentro de la carpeta del proyecto hay un archivo .env
    Cambiar la configuracion de conexion de ejemplo por vuestra configuracion de mysql. La base de datos a connectar la llamamos test.

    DATABASE_URL="mysql://root:root@127.0.0.1:3306/test" cambiar por
    DATABASE_URL="mysql://<user_mysql>:<pass_mysql>@<ip_mysql>:<port:mysql>/test"

Creación de la base de datos con doctrine:

    Nos vamos a la carpeta del proyecto clonado y desde la linea de comandos en el directorio raiz ejecutamos
    php bin/console doctrine:database:create

Migrar datos en la base de datos creado:

    Ahora procederemos a crear las tablas de nuestro modelo de datos
    php bin/console doctrine:migrations:execute --up

Ejecutar bateria de Tests Unitarios:

    Nos vamos a la carpeta del proyecto clonado y desde la linea de comandos en el directorio raiz ejecutamos el script bash.
    sh test.sh

Uso:

    Esta aplicación no dispone de interfaz gráfica o GUI, ya que se ha creado para ser ejecutada por linea de comandos de forma interactiva.
    Para ejecutar la aplicación e interactuar con ella nos vamos a la carpeta del proyecto en el directorio raiz ejecutamos:

    php bin/console app:search-command

    Nos pedirá la palabra a buscar, ponemos por ejemplo azu y le damos a enter, posteriormente saldra el resultado por consola.

Diagrama de Clases:
    Se puede ver dentro del directorio src en la carpeta DocumentacionUML.


