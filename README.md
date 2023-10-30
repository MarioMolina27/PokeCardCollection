# PokeCardCollection - Aplicación de Colección de Cartas Pokémon

PokeCardCollection es una aplicación web que te permite crear, editar y eliminar cartas de Pokémon. Esta aplicación está construida con PHP y utiliza una base de datos MySQL para almacenar la información de las cartas.

## Requisitos

Antes de comenzar, asegúrate de tener instalado lo siguiente:

- Servidor web (por ejemplo, Apache).
- PHP.
- MySQL.

## Configuración de la Base de Datos

1. Crea una base de datos MySQL en tu servidor local utilizando la herramienta de gestión de base de datos que prefieras (por ejemplo, phpMyAdmin).
2. Ejecuta el script SQL proporcionado en el archivo `pokemon.sql` en tu base de datos recién creada. Este script creará la tabla necesaria para la aplicación.

## Configuración de la Aplicación

1. Abre el archivo `bd.php` en la carpeta php_libraries.

2. Modifica los parámetros de la función `openBd` para que coincidan con tu configuración de MySQL:

   ```php
   $servername = "localhost"; // Cambia a la dirección de tu servidor MySQL si es diferente.
   $username = "tu_usuario"; // Cambia a tu nombre de usuario de MySQL.
   $password = "tu_contraseña"; // Cambia a tu contraseña de MySQL.
