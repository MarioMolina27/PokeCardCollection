<?php 
    session_start();
    require_once('../php_libraries/bd.php');
    require_once('../php_libraries/uploadFile.php');

    if (isset($_POST['insert'])) 
    {
        
        insertPokemon($_POST['name'], $_POST['stage'], $_POST['ilustrator'],$_POST['hp'],$_POST['description'],$_POST['category'],$_FILES["imgPokemon"]["name"],$_FILES['imgPokemon2']['name'],$_POST['height'],$_POST['weight'],$_POST['collector-num'],$_POST['rarity'],$_POST['region'],$_POST['preevolution']);
        uploadAllFotos();

        if(isset($_SESSION['error']))
        {
            if (isset($_SESSION['mensaje'])) 
            {
                unset($_SESSION['mensaje']);
                deletePokemon($idPokemon);
            }

            header('Location: ../pokemon.php');
            exit();
        }
        else
        {
            header('Location: ../index.php');
            exit();
        }
    }
    elseif(isset($_POST['pokemon_id_delete']))
    {
        deletePokemon($_POST['pokemon_id_delete']);

        if(isset($_SESSION['error']))
        {
            header('Location: ../index.php');
            exit();
        }
        else
        {
            header('Location: ../index.php');
            exit();
        }
    }
?>