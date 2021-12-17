<?php

    //IMPORTACIONES
    require_once 'conexion.php';

    class Operaciones{

        //ATRIBUTOS
        private $bd = null;

        function __construct(){

            $this->bd = new Conexion();

	}

	function registro($datos){

	    //Comprobar correo
	    if(!str_contains($datos['correo'], 'fundacionloyola.net')){
		return $this->error(0);
	    }

	    //Consulta SQL
	    $sql = 'INSERT INTO usuario(nombre, apellidos, nombreUsuario, correo, password) '.
		'VALUES ("'.$datos['nombre'].'", "'.$datos['apellidos'].'", "'.$datos['usuario'].'", "'.$datos['correo'].'", "'.$datos['password'].'");';

	    //Enviar la consulta
	    $this->bd->consultar($sql);

	    //Comprobar si han habido errores
	    $errno = $this->bd->codigoError();
	    if($errno)
		return $this->error($errno);

	    //Consulta SQL para recibir el id
	    $sql = 'SELECT idUsuario FROM usuario WHERE correo = "'.$datos['correo'].'";';

	    //Enviar la consulta
	    $this->bd->consultar($sql);

	    //Obtener el id
	    $id = $this->bd->extraerFila();

	    //Crear sesión con los datos de registro creados
	    session_start();
	    $_SESSION['id'] = $id['idUsuario'];

	    //Insertar las preferencias del usuario
	    $this->enviarPreferencias($datos['minijuegos'], $id['idUsuario']);

	}

	function recibirPreferencias(){

	    //Consulta SQL
	    $sql = 'SELECT idMinijuego, nombre FROM miniJuego';

	    //Realizar consulta
	    $this->bd->consultar($sql);

	    //Añadir el resultado de la consulta a un array
	    $datos = array();
	    while($fila = $this->bd->extraerFila()){
		array_push($datos, $fila);
	    }

	    //Cerrar conexión
	    $this->bd->cerrarConexion();

	    //Devolver los datos
	    return $datos;

	}

	function enviarPreferencias($datos, $id){

	    //Consulta SQL
	    $sql = 'INSERT INTO preferencia VALUES ';

	    //Concatenarle a la consulta las preferencias elegidas por el usuario
	    foreach ($datos as $preferencia) {
	    	$sql = $sql.'('.$id.', '.$preferencia.'), ';
	    }

	    //Eliminar el último espacio y la última coma
	    $sql = substr($sql, 0, -2);

	    //Enviar la consulta
	    $this->bd->consultar($sql);

	    //Cerrar conexión
	    $this->bd->cerrarConexion();

	    //Redireccionar a index.php
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
