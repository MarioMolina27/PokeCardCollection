<?php
require_once('./php_libraries/bd.php');
$regions = selectRegions();
$types = selectTypes();
$moves = selectMoves();
$pokemons = selectPokemon();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokeCardCollector</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/pokemon.css">

</head>

<body>
    <main>
        <?php
        require_once('php_partials/mensajes.php');

        

        if(isset($_POST['edit']))
        {
            $pokemon = unserialize($_POST['pokemon_data']);
            $pokemonTypes = unserialize($_POST['type_data']);
            $pokemonMoves = unserialize($_POST['moves_data']);
            $_SESSION["idPokemon"] = $_POST["pokemon_id_edit"];
        }

        if (isset($_POST['insert'])) 
        {
            $buttonName = "insert";

            if (isset($_SESSION['pokemon'])) {
                $pokemon = $_SESSION['pokemon'];
                unset($_SESSION['pokemon']);
            } 
    
            else
            {
                $pokemon = [
                    'nombre' => '',
                    'etapa' => '',
                    'ilustrador' => '',
                    'HP' => '',
                    'descripcion' => '',
                    'categoria' => '',
                    'img' => '',
                    'imgSecundaria' => '',
                    'altura' => '',
                    'peso' => '',
                    'num_coleccion' => '',
                    'rareza' => '',
                    'ID_Region' => '',
                    'ID_Preevolucion' => '',
                ];
            }
    
            if (isset($_SESSION['pokemonTypes'])) 
            {
                $pokemonTypes = $_SESSION['pokemonTypes'];
                unset($_SESSION['pokemonTypes']);
            } 
            else 
            {
                $pokemonTypes =
                    [
                        [
                            'id'=> '',
                        ],
                        [
                            'id'=> '',
                        ]
                    ];
            }
            
            if (isset($_SESSION['pokemonMoves'])) 
            {
                $pokemonMoves= $_SESSION['pokemonMoves'];
                unset($_SESSION['pokemonMoves']);
            } 
            else 
            {
                $pokemonMoves = [
                    [
                        'id'=> '',
                        'movimiento_nombre' => '',
                    ],
                    [
                        'id'=> '',
                        'movimiento_nombre' => '',
                    ]
                ];
            }
        } 
        else if (isset($_POST['edit'])) 
        {
            $buttonName = "edit";
        } 
        else
        {
           if(isset($_SESSION["buttonState"]))
           {
                $buttonName = $_SESSION["buttonState"];
                $pokemon = $_SESSION['pokemon'];
                unset($_SESSION['pokemon']);
                $pokemonTypes = $_SESSION['pokemonTypes'];
                unset($_SESSION['pokemonTypes']);
                $pokemonMoves= $_SESSION['pokemonMoves'];
                unset($_SESSION['pokemonMoves']);
           }
           else
           {
            $buttonName = "default";
           }
        }

        $_SESSION["buttonState"] = $buttonName;

        ?>
        
        <div class="pokemonEditContainer">
        <a href="./index.php" class="back-button"><i class="fa-solid fa-arrow-left fa-xl"></i></a>
            <img class="pokeball-image" src="./img/pokeball.svg" alt="">
            <form id="myForm" class =" myForm w-75 p-5 d-flex justify-content-center" action="php_controllers/pokemonController.php"
                method="POST" enctype="multipart/form-data" name = "formPokemon">
                <div class="row g-3 headerPokemon">
                    <div class="row">
                        <h2>Header</h2>
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label mb-0">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                            value="<?php echo $pokemon["nombre"] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="form-label mb-0">Type</label>
                        <select id="type" class="form-select" name="type" required>
                            <option hidden value="">Selecciona un tipo</option>
                            <?php foreach ($types as $type) { ?>
                                <option value="<?php echo $type['id']; ?>" <?php if ($type['id'] == $pokemonTypes[0]['id'])
                                       echo 'selected'; ?>>
                                    <?php echo $type['nombre']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="region" class="form-label mb-0">Region</label>
                        <select class="form-select" aria-label="Default select example" name="region" required>
                            <option hidden value="">Select one region</option>
                            <?php foreach ($regions as $region) { ?>
                                <option value="<?php echo $region['id']; ?>" <?php if ($region['id'] == $pokemon["ID_Region"])
                                       echo 'selected'; ?>>
                                    <?php echo $region['nombre']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="hp" class="form-label mb-0">HP</label>
                        <input type="number" class="form-control" id="hp" placeholder="ex.90" name="hp"
                            value="<?php echo $pokemon["HP"] ?>" required>
                    </div>
                    <div class="col-6">
                        <label for="stage" class="form-label mb-0">Stage</label>
                        <select id="stage" class="form-select" name="stage" required>
                            <option hidden value="Basic">Select the stage</option>
                            <option value="Basic" <?php if ($pokemon['etapa'] == "Basic")
                                echo 'selected'; ?>>BASIC</option>
                            <option value="Stage 1" <?php if ($pokemon['etapa'] == "Stage 1")
                                echo 'selected'; ?>>STAGE 1</option>
                            <option value="Stage 2" <?php if ($pokemon['etapa'] == "Stage 2")
                                echo 'selected'; ?>>STAGE 2</option>
                        </select>
                    </div>
                    <div class="col-6" id="preevolution-input">
                        <label for="preevolution" class="form-label mb-0">Preevolution</label>
                        <select id="preevolution" class="form-select" name="preevolution" required>
                            <option hidden selected value="null">Select the preevolution</option>
                            <?php foreach ($pokemons as $pokemonPre) { ?>
                                <option value="<?php echo $pokemonPre['id']; ?>" <?php if ($pokemonPre['id'] == $pokemon['ID_Preevolucion'])
                                       echo 'selected'; ?>>
                                    <?php echo $pokemonPre['nombre']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row g-3 imagePokemon">
                    <div class="row">
                        <h2>Image</h2>
                    </div>
                    <div class="col-12">
                        <label for="imgPokemon" class="form-label mb-0">Image</label>
                        <input class="form-control" type="file" id="imgPokemon" name="imgPokemon" <?php echo ($_SESSION["buttonState"] === 'insert') ? 'required' : ''; ?>>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <?php 
                            $imgRoute ="./img/no-image.png";
                            $imageHidden = "";
                            if (isset($_POST['edit'])|| isset($_SESSION["previewImage1"])) 
                            {
                                if (isset($_SESSION["previewImage1"]))
                                {
                                    $imgRoute = "./img/pokemon/" .$_SESSION["previewImage1"];
                                    $imageHidden = $_SESSION["previewImage1"];
                                }
                                else
                                {
                                    $imgRoute = "./img/pokemon/" .$pokemon['img'];
                                    $imageHidden = $pokemon['img'];
                                }
                                
                            } 
                        ?>
                        <input type="hidden" name="imgPrincipal" value="<?php echo $imageHidden ?>">
                        <img src="<?php echo $imgRoute ?>" alt="Principal Pokemon Image" class="image-pokemon-form" id="img1Preview">
                    </div>
                    <div class="col-12">
                        <label for="imgPokemon2" class="form-label mb-0">Secondary Image</label>
                        <input class="form-control" type="file" id="imgPokemon2" name="imgPokemon2" <?php echo ($_SESSION["buttonState"] === 'insert') ? 'required' : ''; ?>>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <?php 
                            $imgRoute ="./img/no-image.png";
                            $imageHidden = "";
                            if (isset($_POST['edit'])|| isset($_SESSION["previewImage2"]))
                            {
                                if (isset($_SESSION["previewImage2"]))
                                {
                                    $imgRoute = "./img/pokemon/" .$_SESSION["previewImage2"];
                                    $imageHidden = $_SESSION["previewImage2"];
                                }
                                else
                                {
                                    $imgRoute = "./img/pokemon/" .$pokemon['imgSecundaria'];
                                    $imageHidden = $pokemon['imgSecundaria'];

                                }
                            } 
                        ?>
                        <input type="hidden" name="imgSecondary" value="<?php echo $imageHidden ?>">
                        <img src="<?php echo $imgRoute ?>" alt="Principal Pokemon Image" class="image-pokemon-form" id="img2Preview">
                    </div>
                    <div class="col-md-6">
                        <label for="category" class="form-label mb-0">Category</label>
                        <input class="form-control" type="text" id="category" placeholder="ex.Penguin Pokemon"
                            name="category" value="<?php echo $pokemon["categoria"] ?> "required>
                    </div>
                    <div class="col-md-6">
                        <label for="height" class="form-label mb-0">Height</label>
                        <input class="form-control" type="number" id="height" name="height"
                            value="<?php echo $pokemon["altura"] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="weight" class="form-label mb-0">Weight</label>
                        <input class="form-control" type="number" id="weight" name="weight"
                            value="<?php echo $pokemon["peso"] ?>" required>
                    </div>
                </div>
                <div class="row g-3 movesPokemon">
                    <div class="row">
                        <h2>Moves</h2>
                    </div>
                    <div class="row g-3 move1">
                        <div class="col-12">
                            <label for="fullMove1" class="form-label mb-0">Move 1</label>
                            <select id="fullMove1" class="form-select" name="fullMove1" required>
                                <option hidden value="">Select one move</option>
                                <?php foreach ($moves as $move) { ?>
                                    <option value="<?php echo $move['id']; ?>" <?php if ($move['id'] == $pokemonMoves[0]["id"]) echo 'selected'; ?>>
                                        <?php echo $move['nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 move2">
                        <div class="col-12">
                            <label for="fullMove2" class="form-label mb-0">Move 2</label>
                            <select id="fullMove2" class="form-select" name="fullMove2" required>
                                <option hidden value="">Select one move</option>
                                <?php foreach ($moves as $move) { ?>
                                    <option value="<?php echo $move['id']; ?>" <?php if ($move['id'] == $pokemonMoves[1]["id"]) echo 'selected'; ?>>
                                        <?php echo $move['nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row g-3 footerPokemon">
                    <div class="row">
                        <h2>Footer</h2>
                    </div>
                    <div class="col-md-6">
                        <label for="ilustrator" class="form-label mb-0">Ilustrator</label>
                        <input type="text" class="form-control" id="ilustrator" placeholder="Ilustrator"
                            name="ilustrator" value="<?php echo $pokemon["ilustrador"] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="form-label mb-0">Description</label>
                        <input type="text" class="form-control" id="description" placeholder="Description"
                            name="description" value="<?php echo $pokemon["descripcion"] ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label for="rarity" class="form-label mb-0">Rarity</label>
                        <select id="rarity" class="form-select" name="rarity" required>
                            <option hidden value="">Choose the rarity</option>
                            <option value="Common" <?php if ($pokemon["rareza"] === 'Common')
                                echo 'selected'; ?>>Common
                            </option>
                            <option value="Uncommon" <?php if ($pokemon["rareza"] === 'Uncommon')
                                echo 'selected'; ?>>Uncommon
                            </option>
                            <option value="Rare" <?php if ($pokemon["rareza"] === 'Rare')
                                echo 'selected'; ?>>Rare</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="collector-num" class="form-label mb-0">Colector number</label>
                        <input type="number" class="form-control" id="collector-num" placeholder="Number"
                            name="collector-num" value="<?php echo $pokemon["num_coleccion"] ?>" required>
                    </div>
                </div>
                <button type="submit" name="<?php echo $buttonName; ?>" class="myButton">SAVE</button>
        </div>
        </form>
        </div>
    </main>
    <footer>
        <div class="social-icons">
            <a href="https://github.com/MarioMolina27" target="_blank" rel="noopener noreferrer">
                <i class="fab fa-github"></i>
            </a>
            <a href="https://www.linkedin.com/in/mario-molina-ballesteros-a45a14277/" target="_blank"
                rel="noopener noreferrer">
                <i class="fab fa-linkedin"></i>
            </a>
        </div>
        <p class="footer-copyright">&copy; 2023 mmolinab - Mario Molina</p>
    </footer>
    <script src="./js/shakePokeball.js"></script>
    <script src="./js/formValidation.js"></script>
</body>

</html>