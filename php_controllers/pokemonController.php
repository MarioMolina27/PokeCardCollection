<?php 
    session_start();
    require_once('../php_libraries/bd.php');
    if (isset($_POST['insert'])) 
    {
        
        insertCiudad($_POST['id_ciudad'],$_POST['nombre']);

        if(isset($_SESSION['error']))
        {
            header('Location: ../ciudad.php');
            exit();
        }
        else
        {
            header('Location: ../ciudades.php');
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