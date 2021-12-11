-- BASE DE DATOS
-- ELIMINAR BASE DE DATOS SI EXISTE
DROP DATABASE IF EXISTS RegistroMinijuego;
-- CREAR BASE DE DATOS
CREATE DATABASE RegistroMinijuego DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
-- SELECCIONAR LA BASE DE DATOS
USE RegistroMinijuego;

-- TABLAS
-- Tabla usuario
CREATE TABLE usuario(
    idUsuario smallint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(15) NOT NULL,
    apellidos varchar(30) NOT NULL,
    nombreUsuario varchar(15) NOT NULL,
    correo varchar(100) NOT NULL UNIQUE,
    password varchar(20) NOT NULL
);

-- Tabla Minijuego
CREATE TABLE miniJuego(
    idMinijuego tinyint UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre varchar(20) NOT NULL,
    url varchar(100) NOT NULL
);

-- Tabla Preferencia
CREATE TABLE preferencia(
    idUsuario smallint UNSIGNED NOT NULL,
    idMinijuego tinyint UNSIGNED NOT NULL,
    CONSTRAINT FK_idUsuario FOREIGN KEY (idUsuario) REFERENCES usuario(idUsuario),
    CONSTRAINT FK_idMinijuego FOREIGN KEY (idMinijuego) REFERENCES miniJuego(idMinijuego),
    CONSTRAINT PK_preferencia PRIMARY KEY (idUsuario, idMinijuego)
);
