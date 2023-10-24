<?php
session_start();
function errorMessage($e)
{
    if (!empty($e->errorInfo[1])) {
        switch ($e->errorInfo[1]) {
            case 1062:
                $mensaje = 'Registro duplicado';
                break;
            case 1451:
                $mensaje = 'Para eliminar a ese Pokemon tienes que eliminar antes a su evolucion que depende de este o cambiar antes su preevolución.';
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

function selectTypes()
{
    $conexion = openBd();

    $sentenciaText = "select * from Tipo";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeBd();

    return $resultado;
}

function selectLastPokemonID()
{
    $conexion = openBd();

    $sentenciaText = "SELECT MAX(id) AS id FROM Pokemon";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    $resultado = $sentencia->fetch();

    $conexion = closeBd();

    $idPokemon = $resultado['id'];

    return $idPokemon;
}

function selectMoves()
{
    $conexion = openBd();

    $sentenciaText = "select * from movimiento";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->execute();

    $resultado = $sentencia->fetchAll();

    $conexion = closeBd();

    return $resultado;
}


function insertPokemon($nombre,$stage,$ilustrator,$hp,$descripcion,$categoria,$img,$img2,$altura,$peso,$numColeccion,$rareza,$idRegion,$idPre)
{
    try {
        $conexion = openBd();
        $sentenciaText = "INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
        VALUES (:nombre, :stage, :ilustrator, :hp, :descripcion, :categoria, :img, :img2, :altura, :peso, :numColeccion, :rareza, :idRegion, :idPre);";
        $sentencia = $conexion->prepare($sentenciaText);

        if($stage == "Basic")
        {
            $idPre = null;
        }

        $sentencia->bindParam(':nombre', $nombre);
        $sentencia->bindParam(':stage', $stage);
        $sentencia->bindParam(':ilustrator', $ilustrator);
        $sentencia->bindParam(':hp', $hp);
        $sentencia->bindParam(':descripcion', $descripcion);
        $sentencia->bindParam(':categoria', $categoria);
        $sentencia->bindParam(':img', $img);
        $sentencia->bindParam(':img2', $img2);
        $sentencia->bindParam(':altura', $altura);
        $sentencia->bindParam(':peso', $peso);
        $sentencia->bindParam(':numColeccion', $numColeccion);
        $sentencia->bindParam(':rareza', $rareza);
        $sentencia->bindParam(':idRegion', $idRegion);
        $sentencia->bindParam(':idPre', $idPre);
        $sentencia->execute();
        $_SESSION['mensaje'] = 'Registro insertado correctemente';

        $pokemon = [
            'nombre' => $nombre,
            'stage' => $stage,
            'ilustrator' => $ilustrator,
            'hp' => $hp,
            'descripcion' => $descripcion,
            'categoria' => $categoria,
            'img' => $img,
            'img2' => $img2,
            'altura' => $altura,
            'peso' => $peso,
            'numColeccion' => $numColeccion,
            'rareza' => $rareza,
            'idRegion' => $idRegion,
            'idPre' => $idPre,
        ];
        $idPokemon = selectLastPokemonID();
        insertTypePokemon($_POST['type'],$idPokemon,$pokemon );
        insertMovesPokemon($_POST['fullMove1'],$idPokemon,$pokemon);
        insertMovesPokemon($_POST['fullMove2'],$idPokemon,$pokemon);

    } catch (PDOException $e) {
        $_SESSION['error'] = errorMessage($e);

        $pokemon = [
            'nombre' => $nombre,
            'stage' => $stage,
            'ilustrator' => $ilustrator,
            'hp' => $hp,
            'descripcion' => $descripcion,
            'categoria' => $categoria,
            'img' => $img,
            'img2' => $img2,
            'altura' => $altura,
            'peso' => $peso,
            'numColeccion' => $numColeccion,
            'rareza' => $rareza,
            'idRegion' => $idRegion,
            'idPre' => $idPre,
        ];
        $pokemonTypes = 
        [
            'type1'=> $_POST['type'],
            'type2'=> '',
        ];
        $pokemonMoves =
        [
            "move1" => $_POST['fullMove1'],
            "move2" => $_POST['fullMove2'],
        ];

        $_SESSION['pokemon'] = $pokemon;
        $_SESSION['pokemonTypes'] = $pokemonTypes;
        $_SESSION['pokemonMoves'] = $pokemonMoves;
    }

    $conexion = closeBd();
}

function insertTypePokemon($idTipo,$idPokemon,$pokemon) {
    try 
    {
        $conexion = openBd();


        $sentenciaText = "INSERT INTO Tipo_Pokemon (id_Pokemon, id_Tipo) 
        VALUES (:idPokemon, :idTipo)";
        
        $sentencia = $conexion->prepare($sentenciaText);
        
        // Bind parameters
        $sentencia->bindParam(':idPokemon', $idPokemon);
        $sentencia->bindParam(':idTipo', $idTipo);
        
        $sentencia->execute();
        
        $_SESSION['success'] = "La relación Tipo_Pokemon se ha insertado correctamente.";
    } 
    catch (PDOException $e) 
    {
        $pokemon = [
            'nombre' => $pokemon["nombre"],
            'stage' => $pokemon["stage"],
            'ilustrator' => $pokemon["ilustrator"],
            'hp' => $pokemon["hp"],
            'descripcion' => $pokemon["descripcion"],
            'categoria' => $pokemon["categoria"],
            'img' => $pokemon["img"],
            'img2' => $pokemon["img2"],
            'altura' => $pokemon["altura"],
            'peso' => $pokemon["peso"],
            'numColeccion' => $pokemon["numColeccion"],
            'rareza' => $pokemon["rareza"],
            'idRegion' => $pokemon["idRegion"],
            'idPre' => $pokemon["idPre"],
        ];
        $pokemonTypes = 
        [
            'type1'=> $_POST['type'],
            'type2'=> '',
        ];
        $pokemonMoves =
        [
            "move1" => $_POST['fullMove1'],
            "move2" => $_POST['fullMove2'],
        ];

        $_SESSION['pokemon'] = $pokemon;
        $_SESSION['pokemonTypes'] = $pokemonTypes;
        $_SESSION['pokemonMoves'] = $pokemonMoves;

        $_SESSION['error'] = errorMessage($e);
    }
}

function insertMovesPokemon($idMovimento,$idPokemon,$pokemon) {
    try {
        $conexion = openBd();


        $sentenciaText = "INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) 
        VALUES (:idPokemon, :idMovimiento)";
        
        $sentencia = $conexion->prepare($sentenciaText);
        
        // Bind parameters
        $sentencia->bindParam(':idPokemon', $idPokemon);
        $sentencia->bindParam(':idMovimiento', $idMovimento);
        
        $sentencia->execute();
        
        $_SESSION['success'] = "La relación Tipo_Pokemon se ha insertado correctamente.";
    } 
    catch (PDOException $e) 
    {
        $pokemon = [
            'nombre' => $pokemon["nombre"],
            'stage' => $pokemon["stage"],
            'ilustrator' => $pokemon["ilustrator"],
            'hp' => $pokemon["hp"],
            'descripcion' => $pokemon["descripcion"],
            'categoria' => $pokemon["categoria"],
            'img' => $pokemon["img"],
            'img2' => $pokemon["img2"],
            'altura' => $pokemon["altura"],
            'peso' => $pokemon["peso"],
            'numColeccion' => $pokemon["numColeccion"],
            'rareza' => $pokemon["rareza"],
            'idRegion' => $pokemon["idRegion"],
            'idPre' => $pokemon["idPre"],
        ];
        $pokemonTypes = 
        [
            'type1'=> $_POST['type'],
            'type2'=> '',
        ];
        $pokemonMoves =
        [
            "move1" => $_POST['fullMove1'],
            "move2" => $_POST['fullMove2'],
        ];

        $_SESSION['pokemon'] = $pokemon;
        $_SESSION['pokemonTypes'] = $pokemonTypes;
        $_SESSION['pokemonMoves'] = $pokemonMoves;
        $_SESSION['error'] = errorMessage($e);
    }
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