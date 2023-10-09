<?php
function errorMessage($e)
{
    if (!empty($e->errorInfo[1])) {
        switch ($e->errorInfo[1]) {
            case 1062:
                $mensaje = 'Registro duplicado';
                break;
            case 1451:
                $mensaje = 'Registro con elementos relacionados';
                break;
            default:
                $mensaje = $e->errorInfo[1] . ' - ' . $e->errorInfo[2];
                break;
        }
    } else {
        switch ($e->getCode()) {
            case 1044:
                $mensaje = 'Usuario y/o password incorrecto';
                break;
            case 1049:
                $mensaje = 'Base de datos desconocida';
                break;
            case 2002:
                $mensaje = 'No se encuentra el servidor';
                break;
            default:
                $mensaje = $e->getCode() . ' - ' . $e->getMessage();
                break;
        }
    }
    return $mensaje;
}
function openBd()
{
    $servername = "localhost";
    $username = "root";
    $password = "1234";

    $conexion = new PDO("mysql:host=$servername;dbname=collection", $username, $password);
    // set the PDO error mode to exception
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec('set names utf8');

    return $conexion;
}

function closeBd()
{
    return null;
}

function selectPokemon()
{
    $conexion = openBd();

    $sentenciaText = "select * from pokemon";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeBd();

    return $resultado;
}

function selectPokemonMoves($id_pokemon)
{
    $conexion = openBd();

    $sentenciaText = "
        SELECT Movimiento.nombre AS movimiento_nombre, 
        Movimiento.daño, 
        Movimiento.efecto, 
        Movimiento.ID_Tipo, 
        Tipo.nombre AS tipo_nombre
        FROM Movimiento_Pokemon 
        JOIN Movimiento ON Movimiento.id = Movimiento_Pokemon.id_Movimiento
        JOIN Tipo ON Movimiento.ID_Tipo = Tipo.id
        WHERE Movimiento_Pokemon.id_Pokemon = :id_pokemon;";

    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':id_pokemon', $id_pokemon);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeBd();

    return $resultado;
}

function selectTypeByPokemon($id_pokemon)
{
    $conexion = openBd();

    $sentenciaText = "
    SELECT Tipo.nombre, Tipo.id AS debilidades, Tipo.id AS fortalezas
    FROM Tipo
    INNER JOIN Tipo_Pokemon ON Tipo.id = Tipo_Pokemon.id_Tipo
    INNER JOIN Pokemon ON Tipo_Pokemon.id_Pokemon = Pokemon.id
    WHERE Pokemon.id = :id_pokemon;";

    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':id_pokemon', $id_pokemon);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeBd();

    return $resultado;
}

function selectRegions()
{
    $conexion = openBd();

    $sentenciaText = "select * from region";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeBd();

    return $resultado;
}

function insertCiudad($id_ciudad, $nombre)
{
    try {
        $conexion = openBd();
        $sentenciaText = "insert into ciudades (id_ciudad,nombre) values (:id_ciudad, :nombre)";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':id_ciudad', $id_ciudad);
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->execute();
        $_SESSION['mensaje'] = 'Registro insertado correctemente';

    } catch (PDOException $e) {
        $_SESSION['error'] = errorMessage($e);
        $ciudad['id_ciudad'] = $id_ciudad;
        $ciudad['nombre'] = $nombre;
        $_SESSION['ciudad'] = $ciudad;
    }

    $conexion = closeBd();

}

function insertCadena($cif, $nombre, $dir_fis)
{
    try 
    {
        $conexion = openBd();
        $sentenciaText = "INSERT INTO cadenas (cif, nombre, dir_fis) VALUES (:cif, :nombre, :dir_fis)";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':cif', $cif);
        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':dir_fis', $dir_fis);
        $sentencia->execute();
        $_SESSION['mensaje'] = 'Registro insertado correctamente';
    } 
    catch (PDOException $e) 
    {
        $_SESSION['error'] = errorMessage($e);
        $cadena['cif'] = $cif;
        $cadena['nombre'] = $nombre;
        $cadena['dir_fis'] = $dir_fis;
        $_SESSION['cadena'] = $cadena;
    }

    $conexion = closeBd();
}

function deleteCadena($cif)
{
    try 
    {
        $conexion = openBd();
        $sentenciaText = "delete from cadenas where cif = :cif";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':cif', $cif);
        $sentencia->execute();

    } 
    catch (PDOException $e) 
    {
        $_SESSION['error'] = errorMessage($e);
    }

    $conexion = closeBd();
}

?>