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
        SELECT Movimiento.id AS id,
        Movimiento.nombre AS movimiento_nombre, 
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

function selectTypesByID($id)
{
    $conexion = openBd();

    $sentenciaText = "select nombre from Tipo where id = :id";
    $sentencia = $conexion->prepare($sentenciaText);
    $sentencia->bindParam(':id', $id);
    $sentencia->execute();

    $resultado = $sentencia->fetchColumn();

    $conexion = closeBd();

    return $resultado;
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


function insertPokemon($nombre, $stage, $ilustrator, $hp, $descripcion, $categoria, $img, $img2, $altura, $peso, $numColeccion, $rareza, $idRegion, $idPre)
{
    try {
        $conexion = openBd();
        $conexion->beginTransaction();
        
        $sentenciaText = "INSERT INTO Pokemon (nombre, etapa, ilustrador, HP, descripcion, categoria, img, imgSecundaria, altura, peso, num_coleccion, rareza, ID_Region, ID_Preevolucion)
        VALUES (:nombre, :stage, :ilustrator, :hp, :descripcion, :categoria, :img, :img2, :altura, :peso, :numColeccion, :rareza, :idRegion, :idPre);";
        $sentencia = $conexion->prepare($sentenciaText);

        if ($stage == "Basic") {
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
            'etapa' => $stage,
            'ilustrador' => $ilustrator,
            'HP' => $hp,
            'descripcion' => $descripcion,
            'categoria' => $categoria,
            'img' => $img,
            'img2' => $img2,
            'altura' => $altura,
            'peso' => $peso,
            'num_coleccion' => $numColeccion,
            'rareza' => $rareza,
            'ID_Region' => $idRegion,
            'ID_Preevolucion' => $idPre,
        ];

        $idPokemon = $conexion->lastInsertId();

        if(!isset($_SESSION['error']))
        {
            insertTypePokemon($_POST['type'], $idPokemon, $pokemon, $conexion);
        }

        if(!isset($_SESSION['error']))
        {
            insertMovesPokemon($_POST['fullMove1'], $idPokemon, $pokemon, $conexion);
        }
        
        if(!isset($_SESSION['error']))
        {
            insertMovesPokemon($_POST['fullMove2'], $idPokemon, $pokemon, $conexion);
        }
       
        $conexion->commit();

    } 
    catch (PDOException $e) {
        $_SESSION['error'] = errorMessage($e);
        $conexion->rollback();
        setPokemonSessionData($nombre, $stage, $ilustrator, $hp, $descripcion, $categoria, $img, $img2, $altura, $peso, $numColeccion, $rareza, $idRegion, $idPre, $_POST['type'], $_POST['fullMove1'], $_POST['fullMove2']);
    }

    $conexion = closeBd();
}

function insertTypePokemon($idTipo, $idPokemon, $pokemon,$conexion)
{
    try {
        
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
        $conexion->rollback();
        setPokemonSessionData($pokemon["nombre"], $pokemon["etapa"], $pokemon["ilustrador"], $pokemon["HP"], $pokemon["descripcion"], $pokemon["categoria"], $pokemon["img"], $pokemon["imgSecundaria"], $pokemon["altura"], $pokemon["peso"], $pokemon["num-coleccion"], $pokemon["rareza"], $pokemon["ID_Region"], $pokemon["ID_Preevolucion"], $_POST['type'], $_POST['fullMove1'], $_POST['fullMove2']);
        $_SESSION['error'] = errorMessage($e);
    }
}

function insertMovesPokemon($idMovimento, $idPokemon, $pokemon,$conexion)
{
    try {
        $sentenciaText = "INSERT INTO Movimiento_Pokemon (id_Pokemon, id_Movimiento) 
        VALUES (:idPokemon, :idMovimiento)";

        $sentencia = $conexion->prepare($sentenciaText);

        // Bind parameters
        $sentencia->bindParam(':idPokemon', $idPokemon);
        $sentencia->bindParam(':idMovimiento', $idMovimento);

        $sentencia->execute();

        $_SESSION['success'] = "La relación Tipo_Pokemon se ha insertado correctamente.";
    } 
    catch (PDOException $e) {
        $conexion->rollback();
        $_SESSION['error'] = errorMessage($e);
        setPokemonSessionData($pokemon["nombre"], $pokemon["etapa"], $pokemon["ilustrador"], $pokemon["HP"], $pokemon["descripcion"], $pokemon["categoria"], $pokemon["img"], $pokemon["imgSecundaria"], $pokemon["altura"], $pokemon["peso"], $pokemon["num-coleccion"], $pokemon["rareza"], $pokemon["ID_Region"], $pokemon["ID_Preevolucion"], $_POST['type'], $_POST['fullMove1'], $_POST['fullMove2']);
    }
}

function deletePokemon($id)
{
    try {
        $conexion = openBd();
        $sentenciaText = "delete from pokemon where id = :id";
        $sentencia = $conexion->prepare($sentenciaText);
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();

    } catch (PDOException $e) {
        $_SESSION['error'] = errorMessage($e);
    }

    $conexion = closeBd();
}

function uploadAllFotos()
{
    uploadImage("imgPokemon");
    if (!isset($_SESSION['error'])) 
    {
        uploadImage("imgPokemon2");
        if (isset($_SESSION['error'])) 
        {
            errorUploadFotoSession();
        }
    } 
    else 
    {
        errorUploadFotoSession();
    }
}

function errorUploadFotoSession()
{
    $pokemonTypes =
        [
            [
                'id' => $_POST['type'],
            ],
            [
                'id' => '',
            ]
        ];
    $pokemonMoves = [
        [
            'id' => $_POST['fullMove1'],
            'movimiento_nombre' => '',
        ],
        [
            'id' => $_POST['fullMove2'],
            'movimiento_nombre' => '',
        ]
    ];
    $pokemon = [
        'nombre' => $_POST['name'],
        'etapa' => $_POST['stage'],
        'ilustrador' => $_POST['ilustrator'],
        'HP' => $_POST['hp'],
        'descripcion' => $_POST['description'],
        'categoria' => $_POST['category'],
        'img' => $_FILES["imgPokemon"]["name"],
        'imgSecundaria' => $_FILES['imgPokemon2']['name'],
        'altura' => $_POST['height'],
        'peso' => $_POST['weight'],
        'num_coleccion' => $_POST['collector-num'],
        'rareza' => $_POST['rarity'],
        'ID_Region' => $_POST['region'],
        'ID_Preevolucion' => $_POST['preevolution']
    ];

    $_SESSION['pokemon'] = $pokemon;
    $_SESSION['pokemonTypes'] = $pokemonTypes;
    $_SESSION['pokemonMoves'] = $pokemonMoves;
}

function updatePokemon($id, $nombre, $stage, $ilustrator, $hp, $descripcion, $categoria, $img, $img2, $altura, $peso, $numColeccion, $rareza, $idRegion, $idPre) {
    try {
        $conexion = openBd();
        $conexion->beginTransaction();

        $sentenciaText = "UPDATE Pokemon 
                         SET nombre = :nombre, 
                             etapa = :stage, 
                             ilustrador = :ilustrator, 
                             HP = :hp, 
                             descripcion = :descripcion, 
                             categoria = :categoria, 
                             img = :img, 
                             imgSecundaria = :img2, 
                             altura = :altura, 
                             peso = :peso, 
                             num_coleccion = :numColeccion, 
                             rareza = :rareza, 
                             ID_Region = :idRegion, 
                             ID_Preevolucion = :idPre 
                         WHERE id = :id";
        $sentencia = $conexion->prepare($sentenciaText);

        if ($stage == "Basic") {
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
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();
        
        $_SESSION['mensaje'] = 'Registro actualizado correctamente';

        $pokemon = [
            'nombre' => $nombre,
            'etapa' => $stage,
            'ilustrador' => $ilustrator,
            'HP' => $hp,
            'descripcion' => $descripcion,
            'categoria' => $categoria,
            'img' => $img,
            'img2' => $img2,
            'altura' => $altura,
            'peso' => $peso,
            'num_coleccion' => $numColeccion,
            'rareza' => $rareza,
            'ID_Region' => $idRegion,
            'ID_Preevolucion' => $idPre,
        ];

        if (!isset($_SESSION['error'])) {
            deleteTypePokemon($id, $pokemon,$conexion);
        }
        
        if (!isset($_SESSION['error'])) {
            insertTypePokemon($_POST['type'], $id, $pokemon, $conexion);
        }
        
        if (!isset($_SESSION['error'])) {
            deleteMovesPokemon($id, $pokemon,$conexion);
        }
        
        if (!isset($_SESSION['error'])) {
            insertMovesPokemon($_POST['fullMove1'], $id, $pokemon, $conexion);
        }
        
        if (!isset($_SESSION['error'])) {
            insertMovesPokemon($_POST['fullMove2'], $id, $pokemon, $conexion);
        }

        unset($_SESSION['previewImage1']);
        unset($_SESSION['previewImage2']);

        $conexion->commit();

    } 
    catch (PDOException $e) 
    {
        $_SESSION['error'] = errorMessage($e);
        $conexion->rollback();
        setPokemonSessionData($nombre, $stage, $ilustrator, $hp, $descripcion, $categoria, $img, $img2, $altura, $peso, $numColeccion, $rareza, $idRegion, $idPre, $_POST['type'], $_POST['fullMove1'], $_POST['fullMove2']);
    }

    $conexion = closeBd();
}

function deleteTypePokemon($idPokemon,$pokemon,$conexion) {
    try {

        $deleteStatement = "DELETE FROM Tipo_Pokemon WHERE id_Pokemon = :idPokemon";
        $deleteQuery = $conexion->prepare($deleteStatement);
        $deleteQuery->bindParam(':idPokemon', $idPokemon);
        $deleteQuery->execute();

        $_SESSION['success'] = "La relación Tipo_Pokemon se ha eliminado correctamente.";
    } 
    catch (PDOException $e) 
    {
        $_SESSION['error'] = errorMessage($e);
        $conexion->rollback();
        setPokemonSessionData($pokemon["nombre"], $pokemon["etapa"], $pokemon["ilustrador"], $pokemon["HP"], $pokemon["descripcion"], $pokemon["categoria"], $pokemon["img"], $pokemon["imgSecundaria"], $pokemon["altura"], $pokemon["peso"], $pokemon["num-coleccion"], $pokemon["rareza"], $pokemon["ID_Region"], $pokemon["ID_Preevolucion"], $_POST['type'], $_POST['fullMove1'], $_POST['fullMove2']);
    }
    $conexion = closeBd();
}


function deleteMovesPokemon($idPokemon,$pokemon,$conexion) {
    try {

        $deleteStatement = "DELETE FROM Movimiento_Pokemon WHERE id_Pokemon = :idPokemon";
        $deleteQuery = $conexion->prepare($deleteStatement);
        $deleteQuery->bindParam(':idPokemon', $idPokemon);
        $deleteQuery->execute();

        $_SESSION['success'] = "Los registros de Movimiento_Pokemon se han eliminado correctamente para el Pokemon con ID: $idPokemon.";
    } 
    catch (PDOException $e) 
    {
        $conexion->rollback();
        setPokemonSessionData($pokemon["nombre"], $pokemon["etapa"], $pokemon["ilustrador"], $pokemon["HP"], $pokemon["descripcion"], $pokemon["categoria"], $pokemon["img"], $pokemon["imgSecundaria"], $pokemon["altura"], $pokemon["peso"], $pokemon["num-coleccion"], $pokemon["rareza"], $pokemon["ID_Region"], $pokemon["ID_Preevolucion"], $_POST['type'], $_POST['fullMove1'], $_POST['fullMove2']);
        $_SESSION['error'] = errorMessage($e);
    }
    $conexion = closeBd();
}

function setPokemonSessionData($nombre, $stage, $ilustrator, $hp, $descripcion, $categoria, $img, $img2, $altura, $peso, $numColeccion, $rareza, $idRegion, $idPre, $type, $fullMove1, $fullMove2) {
    $pokemon = [
        'nombre' => $nombre,
        'etapa' => $stage,
        'ilustrador' => $ilustrator,
        'HP' => $hp,
        'descripcion' => $descripcion,
        'categoria' => $categoria,
        'img' => $img,
        'imgSecundaria' => $img2,
        'altura' => $altura,
        'peso' => $peso,
        'num_coleccion' => $numColeccion,
        'rareza' => $rareza,
        'ID_Region' => $idRegion,
        'ID_Preevolucion' => $idPre,
    ];

    $pokemonTypes = [
        [
            'id' => $type,
        ],
        [
            'id' => '',
        ]
    ];

    $pokemonMoves = [
        [
            'id' => $fullMove1,
            'movimiento_nombre' => '',
        ],
        [
            'id' => $fullMove2,
            'movimiento_nombre' => '',
        ]
    ];

    $_SESSION['pokemon'] = $pokemon;
    $_SESSION['pokemonTypes'] = $pokemonTypes;
    $_SESSION['pokemonMoves'] = $pokemonMoves;
}
?>