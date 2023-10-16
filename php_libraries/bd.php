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

function selectPokemonByName($name)
{
    $conexion = openBd();

    $sentenciaText = "SELECT * FROM pokemon WHERE nombre LIKE :name";
    $sentencia = $conexion->prepare($sentenciaText);
    
    $name = '%' . $name . '%';
    
    $sentencia->bindParam(':name', $name);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeBd();

    return $resultado;
}

function selectPokemonByRegion($id)
{
    $conexion = openBd();

    $sentenciaText = "SELECT * FROM pokemon WHERE ID_Region = :id";
    $sentencia = $conexion->prepare($sentenciaText);
    
    $sentencia->bindParam(':id', $id);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeBd();

    return $resultado;
}

function selectPokemonByID($id)
{
    $conexion = openBd();

    $sentenciaText = "select * from pokemon where id = :id;";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':id', $id);
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
    SELECT Tipo.id as id,Tipo.nombre, Tipo.id AS debilidades, Tipo.id AS fortalezas
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

function selectTypeWeakness($id)
{
    $conexion = openBd();

    $sentenciaText = "
    SELECT Tipo.nombre AS Tipo_Pokemon,
       GROUP_CONCAT(DISTINCT Debilidades.nombre) AS Debilidades,
       GROUP_CONCAT(DISTINCT Fortalezas.nombre) AS Fortalezas
        FROM Tipo
        LEFT JOIN Tipo_Pokemon AS TP ON Tipo.id = TP.id_Tipo
        LEFT JOIN Tipo AS Debilidades ON Debilidades.id = Tipo.debilidades
        LEFT JOIN Tipo AS Fortalezas ON Fortalezas.id = Tipo.fortalezas
        WHERE Tipo.id = :id
        GROUP BY Tipo_Pokemon;";

    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':id', $id);
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

function deletePokemon($id)
{
    try 
    {
        $conexion = openBd();
        $sentenciaText = "delete from pokemon where id = :id";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();

    } 
    catch (PDOException $e) 
    {
        $_SESSION['error'] = errorMessage($e);
    }

    $conexion = closeBd();
}
?>