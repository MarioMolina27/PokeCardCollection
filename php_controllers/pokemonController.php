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
    else if (isset($_POST['edit']))
    {
        
        if (!empty($_FILES['imgPokemon']['tmp_name']) && !empty($_FILES['imgPokemon2']['tmp_name'])) 
        {
            uploadAllFotos();
            if(!isset($_SESSION["error"]))
            {
                updatePokemon($_SESSION["idPokemon"], $_POST['name'], $_POST['stage'], $_POST['ilustrator'], $_POST['hp'], $_POST['description'], $_POST['category'], $_FILES["imgPokemon"]["name"], $_FILES['imgPokemon2']['name'], $_POST['height'], $_POST['weight'], $_POST['collector-num'], $_POST['rarity'], $_POST['region'], $_POST['preevolution']);
                unset($_SESSION['previewImage1']);
                unset($_SESSION['previewImage2']);
            }
            else
            {
                assignSessionImagePreview();
                setPokemonSessionData($_POST['name'], $_POST['stage'], $_POST['ilustrator'],$_POST['hp'],$_POST['description'],$_POST['category'],$_FILES["imgPokemon"]["name"],$_FILES['imgPokemon2']['name'],$_POST['height'],$_POST['weight'],$_POST['collector-num'],$_POST['rarity'],$_POST['region'],$_POST['preevolution'], $_POST['type'], $_POST['fullMove1'], $_POST['fullMove2']);
            }
        } 
        else if (!empty($_FILES['imgPokemon']['tmp_name']) && empty($_FILES['imgPokemon2']['tmp_name'])) 
        {
            uploadImage("imgPokemon");
            if(!isset($_SESSION["error"]))
            {
                updatePokemon($_SESSION["idPokemon"], $_POST['name'], $_POST['stage'], $_POST['ilustrator'], $_POST['hp'], $_POST['description'], $_POST['category'], $_FILES["imgPokemon"]["name"], $_POST['imgSecondary'], $_POST['height'], $_POST['weight'], $_POST['collector-num'], $_POST['rarity'], $_POST['region'], $_POST['preevolution']);
                unset($_SESSION['previewImage1']);
                unset($_SESSION['previewImage2']);
            }
            else
            {
                assignSessionImagePreview();
                setPokemonSessionData($_POST['name'], $_POST['stage'], $_POST['ilustrator'],$_POST['hp'],$_POST['description'],$_POST['category'],$_FILES["imgPokemon"]["name"],$_FILES['imgPokemon2']['name'],$_POST['height'],$_POST['weight'],$_POST['collector-num'],$_POST['rarity'],$_POST['region'],$_POST['preevolution'], $_POST['type'], $_POST['fullMove1'], $_POST['fullMove2']);

            }

        } 
        else if (empty($_FILES['imgPokemon']['tmp_name']) && !empty($_FILES['imgPokemon2']['tmp_name'])) 
        {
            uploadImage("imgPokemon2");
            if(!isset($_SESSION["error"]))
            {
                updatePokemon($_SESSION["idPokemon"], $_POST['name'], $_POST['stage'], $_POST['ilustrator'], $_POST['hp'], $_POST['description'], $_POST['category'], $_POST['imgPrincipal'], $_FILES['imgPokemon2']['name'], $_POST['height'], $_POST['weight'], $_POST['collector-num'], $_POST['rarity'], $_POST['region'], $_POST['preevolution']);
                unset($_SESSION['previewImage1']);
                unset($_SESSION['previewImage2']);
            }
            else
            {
                assignSessionImagePreview();
                setPokemonSessionData($_POST['name'], $_POST['stage'], $_POST['ilustrator'],$_POST['hp'],$_POST['description'],$_POST['category'],$_FILES["imgPokemon"]["name"],$_FILES['imgPokemon2']['name'],$_POST['height'],$_POST['weight'],$_POST['collector-num'],$_POST['rarity'],$_POST['region'],$_POST['preevolution'], $_POST['type'], $_POST['fullMove1'], $_POST['fullMove2']);
            }
        } 
        else 
        {
            updatePokemon($_SESSION["idPokemon"], $_POST['name'], $_POST['stage'], $_POST['ilustrator'], $_POST['hp'], $_POST['description'], $_POST['category'], $_POST['imgPrincipal'], $_POST['imgSecondary'], $_POST['height'], $_POST['weight'], $_POST['collector-num'], $_POST['rarity'], $_POST['region'], $_POST['preevolution']);
            unset($_SESSION['previewImage1']);
            unset($_SESSION['previewImage2']);
        }

        if(isset($_SESSION['error']))
        {
            header('Location: ../pokemon.php');
            exit();
        }
        else
        {
            header('Location: ../index.php');
            exit();
        }
    }
    else if(isset($_POST['pokemon_id_delete']))
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
    else
    {
        header('Location: ../index.php');
        exit();
    }

    function assignSessionImagePreview()
    {
        if (isset($_POST['imgPrincipal']) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $_POST['imgPrincipal'])) 
        {
            $_SESSION["previewImage1"] = $_POST['imgPrincipal'];
        }
        
        if (isset($_POST['imgSecondary']) && preg_match('/\.(jpg|jpeg|png|gif)$/i', $_POST['imgSecondary'])) 
        {
            $_SESSION["previewImage2"] = $_POST['imgSecondary'];
        }
    }
?>