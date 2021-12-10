<?php

    //IMPORTACIONES
    require_once 'config/config.php';

    class Conexion{

        //ATRIBUTOS
        private $conexion = null;
        private $resultado = null;

        function __construct(){

            //OBJETOS
            // Se instancia un objeto desde la clase mysqli con los datos 
            // de conexión importados en forma de constantes desde configdb.php
            $this->conexion = new mysqli(SERVIDOR, USUARIO, PASSWD, DATABASE);

        }

        function consultar($sql){

            return $this->resultado = $this->conexion->query($sql);

        }

        function extraerFila(){

            return $this->resultado->fetch_array(MYSQLI_ASSOC);

        }

        function numeroFilas(){

            return $this->resultado->num_rows;

        }

        function filasAfectadas(){


            
        }

        function codigoError(){

            return $this->conexion->errno;

        }

        function cerrarConexion(){

            $this->conexion->close();

        }
    }
