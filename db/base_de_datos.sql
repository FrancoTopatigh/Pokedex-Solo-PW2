CREATE DATABASE IF NOT EXISTS pokedex;
USE pokedex;

CREATE TABLE IF NOT EXISTS pokemon (
                                       id INT AUTO_INCREMENT PRIMARY KEY,
                                       numero INT NOT NULL,
                                       nombre VARCHAR(50) NOT NULL,
    tipo VARCHAR(20) NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    descripcion TEXT
    );

CREATE TABLLE IF NOT EXISTS usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(40) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    esAdmin BOOLEAN
);
