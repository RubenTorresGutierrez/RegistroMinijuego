<?php

    //IMPORTACIONES
    require_once 'clases/operaciones.php';

    //OBJETOS
    $operaciones = new Operaciones();

    if(isset($_POST['enviar']))
	if(!empty($_POST['correo']) && !empty($_POST['password']))
	    $operaciones->iniciarSesion($_POST);

?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta name="author" content="rtorresgutierrez.guadalupe@alumnado.fundacionloyola.net" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Iniciar Sesión</title>
        <!-- CSS -->
        <link rel=stylesheet href=css/style.css />
        <!-- ICONOS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    </head>
    <body>
	<main>
	    <form action="index.php" method="POST">
		<h1>INICIAR SESIÓN</h1>
		<!-- CORREO -->
		<input type="email" name="correo" placeholder="Correo" />
		<!-- CONTRASEÑA -->
		<input type="password" name="password" placeholder="Contraseña" />
		<!-- ENVIAR -->
		<input type="submit" name="enviar" value="INICIAR" />
	    </form>
	</main>
    </body>
</html>
