<?php

    //IMPORTACIONES
    require_once 'clases/operaciones.php';

    //OBJETOS
    $operaciones = new Operaciones();

    if(isset($_POST['enviar']))
	if(!empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['usuario']) && !empty($_POST['correo']) && !empty($_POST['password']) && !empty($_POST['minijuegos']))
	    $operaciones->registro($_POST);
    
    //Recibir todos los minijuegos
    $datos = $operaciones->recibirPreferencias();

?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta name="author" content="rtorresgutierrez.guadalupe@alumnado.fundacionloyola.net" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Registro</title>
        <!-- CSS -->
        <link rel=stylesheet href=css/style.css />
        <!-- ICONOS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    </head>
    <body>
	<main>
	    <form action="registro.php" method="POST">
		<h1>REGISTRO</h1>
		<legend>Datos de Usuario</legend>
		<!-- NOMBRE -->
		<input type="text" name="nombre" placeholder="Nombre" />
		<!-- APELLIDOS -->
		<input type="text" name="apellidos" placeholder="Apellidos" />
		<!-- USUARIO -->
		<input type="text" name="usuario" placeholder="Usuario" />
		<!-- CORREO -->
		<input type="email" name="correo" placeholder="Correo" />
		<!-- CONTRASEÑA -->
		<input type="password" name="password" placeholder="Contraseña" />
		<legend>Preferencias</legend>
		<?php

		    foreach($datos as $fila){
			echo '<div>';
			echo '<input id="'.$fila['idMinijuego'].'" type="checkbox" name="minijuegos[]" value="'.$fila['idMinijuego'].'" />';
			echo '<label for="'.$fila['idMinijuego'].'"> '.$fila['nombre'].'</label>';
			echo '</div>';
		    }

		?>
		<!-- ENVIAR -->
		<input type="submit" name="enviar" value="ENVIAR" />
	    </form>
	</main>
    </body>
</html>
