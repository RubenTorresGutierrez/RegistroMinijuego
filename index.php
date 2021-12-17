<?php

    //Comprobar si hay una sesión activa
    session_start();
    if(!isset($_SESSION['id']))
	header('Location:inicio.php');

    //IMPORTACIONES
    require_once 'clases/operaciones.php';

    //OBJETOS
    $operaciones = new Operaciones();

    //Obtener nombre del usuario
    echo $operaciones->nombreUsuario($_SESSION['id']);
