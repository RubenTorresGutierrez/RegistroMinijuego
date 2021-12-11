<?php

    //Comprobar si hay una sesión activa
    session_start();
    if(!isset($_SESSION['id']))
	header('Location:index.php');

    //IMPORTACIONES
    require_once 'clases/operaciones.php';

    //OBJETOS
    $operaciones = new Operaciones();

    if(isset($_POST['enviar']))
	if(!empty($_POST['minijuegos']))
	    $operaciones->enviarPreferencias($_POST, $_SESSION['id']);
    $datos = $operaciones->recibirPreferencias();

?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <meta name="author" content="rtorresgutierrez.guadalupe@alumnado.fundacionloyola.net" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Preferencias</title>
        <!-- CSS -->
        <link rel=stylesheet href=css/style.css />
        <!-- ICONOS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    </head>
    <body>
	<form action="preferencias.php" method="POST">
	    <label for="minijuegos">Selecciona tus preferencias:</label>
	    <?php

	        while($fila = $operaciones->extraerFila()){
		    echo '<input id="'.$fila['idMinijuego'].'" type="checkbox" name="minijuegos[]" value="'.$fila['idMinijuego'].'" />';
		    echo '<label for="'.$fila['idMinijuego'].'">'.$fila['nombre'].'</label>';
		}

	    ?>
	    <input type="submit" name="enviar" value="ENVIAR" />
	</form>
    </body>
</html>
