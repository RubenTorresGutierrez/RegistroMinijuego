<?php

    //IMPORTACIONES
    require_once 'conexion.php';

    class Operaciones{

        //ATRIBUTOS
        private $bd = null;

        function __construct(){

            $this->bd = new Conexion();

	}

	function iniciarSesion($datos){

	    //Consulta SQL
	    $sql = 'SELECT idUsuario FROM usuario WHERE correo = "'.$datos['correo'].'" AND password = "'.$datos['password'].'"';

	    //Enviar la consulta
	    $this->bd->consultar($sql);

	    //Comprobar si ha habido error
	    if($this->bd->codigoError())
		return;

	    //Obtener el resultado de la consulta
	    $resultado = $this->bd->extraerFila();

	    //Crear sesión con el id del usuario
	    session_start();
	    $_SESSION['id'] = $resultado['idUsuario'];

	    //Redirigir a index.php
	    header('Location:index.php');

	}

	function error($errno){

	   switch ($errno) {
	   	case 0:
	   	    echo 'El correo no pertenece a la Fundación';
		    break;
		case 1062:
		    echo 'El correo introducido ya está registrado';
		    break;
		case 1406:
		    echo 'Uno de los campos tiene una longitud mayor de la permitida';
		    break;
	   	default:
		    echo 'Ha ocurrido un error inesperado';
	   	    break;
	   } 

	}

	function nombreUsuario($id){

	    //Consulta SQL
	    $sql = 'SELECT nombreUsuario FROM usuario WHERE idUsuario = '.$id.'';

	    //Enviar la consulta
	    $this->bd->consultar($sql);

	    //Obtener resultado
	    $resultado = $this->bd->extraerFila();
	    
	    //Cerrar conexión
	    $this->bd->cerrarConexion();

	    //Devolver resultado
	    return $resultado['nombreUsuario'];

	}

    }
