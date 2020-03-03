<p align="center"><img src="public/img/GitHub/LogoGrandeNegro.png" alt="" width="500px"/> </p>

<h3>Requisitos previos</h3>
<p>El siguiente manual esta enfocado para ejecutar la aplicación en el sistema operativo Windows, por loque el requisito previo será tener una maquina con Windows 10</p>
<h3>Inventario de componentes</h3>
<p>Para ejecutar la aplicación, necesitaremos instalar y/o descargar los siguientes componentes:</p>
<p>1.  Laragon</p>
<h3> Procedimientos de instalación</h3>
<p>En primer lugar, descargaremos Laragon desde su página oficial y lo instalaremos en nuestra maquina.</p>
<p>Ejecutamos Laragon y seleccionamos Iiciar Todo y abrimos un nuevo terminal.</p>
<p align="center"><img src="public/img/GitHub/Instalacion1.PNG" alt="" width="500px"/> </p>
<p>En el terminal, escribimos el comandocd www/DevEnglishpara acceder al directorio de la aplicaión.</p>
<p align="center""><img src="public/img/GitHub/Instalacion2.PNG" alt="" width="500px"/> </p>
<p>Una vez ubicados en el directorio de la aplicación, con el comando composer install, instalamos lasdependencias necesarias (Este proceso puede tardar unos minutos).</p>
<p align="center""><img src="public/img/GitHub/Instalacion3.PNG" alt="" width="500px"/> </p>
<p>En el navegador, accedemos al panel de phpmyadmin mediante la url:http://localhost/phpmyadmin/index.php,seleccionamos la opciónNewy asignamos el nombredevenglisha la base de datos que crearemos. Oen su defecto, importamos la base de datosdevenglish.slqlocalizada en el directorio de este proyecto.</p>
<p align="center""><img src="public/img/GitHub/Instalacion4.PNG" alt="" width="500px"/> </p>
<p>En el directorio base de la aplicación (C:/laragon/www/DevEnglish), creamos un fichero llamado .env con la siguiente información (Los campos DB_USERNAME y DB_PASSWORD pueden variar dependiendo del usuario y contraseña de phpmyadmin):</p>
<p align="center""><img src="public/img/GitHub/Instalacion5.PNG" alt="" width="500px"/></p> 
<p>A continuación, con los comandosphp artisan migrateyphp artisan db:seed, creamos y rellenamoslas tablas y relaciones en la base de datos (Omitimos este paso si hemos importado la base de datos devenglish.slq del directorio del proyecto).</p>
<p>Con el comando php artisan servese inicia el servidor, si todos los pasos anteriores se han seguido correctamente, podremos acceder a la aplicación mediante la url http://localhost:8000/.</p>
<p align="center""><img src="public/img/GitHub/Instalacion6.PNG" alt="" width="500px"/> </p>
<p>Los credenciales para acceder al panel de administración podemos modificarlas antes de usar el comandophp artisan db:seed cambiando la configuración de la semilla de Usuario, esta se encuentra en la carpeta/database/seedsen el archivo UserTableSeeder.php.</p></p>
<p align="center""><img src="public/img/GitHub/Instalacion7.PNG" alt="" width="500px"/> </p>
<p>Cambiando los camposemail y password modificamos las credenciales para el inicio de sesión del administrador.</p>
<p align="center""><img src="public/img/GitHub/Instalacion8.PNG" alt="" width="500px"/> </p>
<p>Para hacer administrador a un usuario, cambiamos el campo user_type_id para que su valor sea 1.</p>
