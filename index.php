<?php
    require_once('./php_libraries/bd.php');
    require_once('./php_libraries/php_card_colors.php');
    $pokemonSearch ="";
    $pokemonRegion = 0;
    if (isset($_POST["pokemon_name"])) 
    {
        $pokemonName = $_POST["pokemon_name"];
        $pokemons = selectPokemonByName($pokemonName);
        $pokemonSearch = $pokemonName;
    }
    else if(isset($_POST["region_select"]))
    {
        $pokemonRegion = $_POST["region_select"];
        if($pokemonRegion == 0)
        {
            $pokemons = selectPokemon();
        }
        else
        {
            $pokemons= selectPokemonByRegion($pokemonRegion);
        }
    }
    else
    {
        $pokemons = selectPokemon();
    }

    $regions = selectRegions();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PokeCardCollector</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.png">
    <link rel="stylesheet" href="./css/card.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header>
        <h1>POKEMON CARD COLLECTION</h1>
    </header>
    <main>


    <div class="container-fluid mt-5 mb-5 d-flex justify-content-center">
        <div class="row d-flex align-items-center w-100">
            <div class="col d-flex">
                <form action ="index.php" method="POST" class="w-100 d-flex">
                    <input type="text" class="form-control " placeholder="Name" aria-label="Pokemon Name" name="pokemon_name" value="<?php echo $pokemonSearch ?>">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div class="col d-flex justify-content-center">
                <form method="POST">
                    <button type="submit" class="btn btn-success btn-lg rounded-circle"><i class="fa-solid fa-plus"></i></button>
                </form>
            </div>

            <div class="col d-flex">
                <form action ="index.php" method="POST" class="w-100 d-flex">
                    <select class="form-select" aria-label="Default select example" name="region_select">
                        <option value="0" <?php if($pokemonRegion == 0) echo 'selected'; ?>>All Regions</option>
                        <?php foreach ($regions as $region) { ?>
                            <option value="<?php echo $region['id']; ?>" <?php if($pokemonRegion== $region['id']) echo 'selected'; ?>>
                                <?php echo $region['nombre']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </div>
    </div>
    <?php require_once('php_partials/mensajes.php');?>
        <div class="project-container mb-5">
            <?php foreach ($pokemons as $pokemon) { 
                $pokemonMoves = selectPokemonMoves($pokemon["id"]);
                $pokemonTypes = selectTypeByPokemon($pokemon["id"]);
                $hexType = getHexColor($pokemonTypes[0]['nombre']);
                $typeWeakness = [];
                foreach ($pokemonTypes as $type ) 
                {
                    $typeW = selectTypeWeakness($type["id"]);
                    $typeWeakness = array_merge($typeWeakness, $typeW);
                }
                $evolution = "no-evolution";
                $pokemonPreevolution = selectPokemonByID($pokemon["ID_Preevolucion"]);
                if($pokemon["ID_Preevolucion"] !== null)
                {
                    $evolution = "evolution";
                } 
            ?>
                <div class="card-element fadeIn">
                    <div class="pokemon-card" style="background-color: <?php echo $hexType ?>;">
                        <div class="pokemon-card-inner">
                            <div class="pokemon-card-header">
                                <div class="header-left">
                                    <div class="pokemon-stage">
                                        <div class="pokemon-stage-name">
                                            <p class="text-stage"><?php echo $pokemon['etapa']?></p>
                                        </div>
                                        <div class="preevolution-container <?php echo $evolution ?>">
                                            <div class="preevolution-image-container">
                                                <img src="img/pokemon/<?php echo $pokemonPreevolution[0]["imgSecundaria"]?>" alt="" class="preevolution-img">
                                            </div>
                                            <div class="preevolution-text-container">
                                                <p>Evolves from <?php echo $pokemonPreevolution[0]["nombre"]?> </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pokemon-name">
                                        <p class="text-pokemon-name"><?php echo $pokemon['nombre']?></p>
                                    </div>
                                </div>
                                <div class="pokemon-hp">
                                    <p class="title-hp">HP</p>
                                    <p class="hp-value"><?php echo $pokemon['HP']?></p>
                                    <img src="img/<?php echo strtolower($pokemonTypes[0]["nombre"])?>-type.png" alt="-type" class="type-img">
                                </div>
                            </div>
                            <div class="image-section">
                                <img src="img/pokemon/<?php echo $pokemon['img']?>" alt="<?php echo $pokemon['nombre']?>" class="pokemon-img">
                                <div class="img-info">
                                    <p>NO.<?php echo $pokemon['id']?></p>
                                    <p><?php echo $pokemon['categoria']?></p>
                                    <p>HT: <?php echo $pokemon['altura']?></p>
                                    <p>WT: <?php echo $pokemon['peso']?> lbs.</p>
                                </div>
                            </div>
                            <div class="movements-section">
                                <?php foreach ($pokemonMoves as $move) { ?>
                                    <div class="move">
                                        <div class="type">
                                            <img src="./img/<?php echo $move['tipo_nombre']?>-type.png" alt="normal-type" class="type-move-img">
                                        </div>
                                        <div class="movement-name">
                                            <p><?php echo $move["movimiento_nombre"]?></p>
                                        </div>
                                        <div class="movement-damage">
                                            <p><?php echo $move["daño"]?></p>
                                        </div>
                                    </div>
                                    <p class="move-description"><?php echo $move["efecto"]?></p>
                                <?php } ?>
                                <div class="move">
                                </div>
                                
                            </div>
                            <div class="weak-retreat-section">
                                <div class="weak-and-resistance-container">
                                    <div class="weak-container">
                                        <p class="weakness-text">weakness</p>
                                        <?php foreach ($typeWeakness as $weak ) {?>
                                            <img src="img/<?php echo strtolower($weak['Debilidades']);?>-type.png" alt="electric-type" class="type-img-mini">
                                        <?php }?>
                                    </div>
                                    <div class="resistance-container">
                                        <p class="resistance-text">resistance</p>
                                        <?php foreach ($typeWeakness as $weak ) {?>
                                            <img src="img/<?php echo strtolower($weak['Fortalezas']);?>-type.png" alt="electric-type" class="type-img-mini">
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="footer-left">
                                    <p class="ilustrator-name"> <?php echo $pokemon['ilustrador']?></p>
                                    <div class="rarety-variables">
                                        <img src="img/symbol.png" alt="normal-type" class="rarerty-simbols-img">
                                        <p>32/156</p>
                                        <img src="img/point.png" alt="normal-type" class="rarerty-simbols2-img">
                                    </div>
                                    <p class="copyright">©2018 Pokemon</p>
                                </div>
                                <div class="footer-right">
                                    <p>
                                    <?php echo $pokemon['descripcion']?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-container">
                        <form action="">
                            <input type="hidden" name="pokemon_id_edit" value="<?php echo $pokemon['id']?>">
                            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-pencil"></i> | Edit</button>
                        </form>
                        <form action="php_controllers/pokemonController.php" method="POST">
                            <input type="hidden" name="pokemon_id_delete" value="<?php echo $pokemon['id']?>">
                            <button type="sumbit" class="btn btn-danger"><i class="fa-solid fa-trash"></i> | Delete</button>                     
                        </form>
                    </div>
                </div>
            <?php } ?>
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
   <script src="js/fadeIn.js"></script>
</body>

</html>