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
        <?php require_once('php_partials/mensajes.php');?>
        <div class="pokemonEditContainer">
        <img class="pokeball-image" src="./img/pokeball.svg" alt="">
            <form id="myForm  w-75 p-5 d-flex align-items-center" action="php_controllers/pokemonController.php" method="POST" enctype="multipart/form-data">
                <div class="row g-3 headerPokemon">
                    <div class="row">
                        <h2>Header</h2>
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label mb-0">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="form-label mb-0">Type</label>
                        <select id="type" class="form-select" name="type">
                            <option hidden selected value value="0">Select one type</option>
                            <?php foreach ($types as $type) { ?>
                                <option value="<?php echo $type['id']; ?>">
                                    <?php echo $type['nombre']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="region" class="form-label mb-0">Region</label>
                        <select class="form-select" aria-label="Default select example" name="region">
                            <option hidden selected value value="0">Select one region</option>
                            <?php foreach ($regions as $region) { ?>
                                <option value="<?php echo $region['id']; ?>">
                                    <?php echo $region['nombre']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="stage" class="form-label mb-0">Stage</label>
                        <select id="stage" class="form-select" name="stage">
                            <option hidden selected value value="0">Select the stage</option>
                            <option value ="Basic">BASIC</option>
                            <option value ="Stage 1">STAGE 1</option>
                            <option value ="Stage 2">STAGE 2</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="hp" class="form-label mb-0">HP</label>
                        <input type="number" class="form-control" id="hp" placeholder="ex.90" name="hp">
                    </div>
                    <div class="col-6 preevolution-input">
                        <label for="preevolution" class="form-label mb-0">Preevolution</label>
                        <select id="preevolution" class="form-select" name="preevolution">
                                <option hidden selected value value="0">Select one move</option>
                                <?php foreach ($pokemons as $pokemon) { ?>
                                    <option value="<?php echo $pokemon['id']; ?>">
                                        <?php echo $pokemon['nombre']; ?>
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
                        <input class="form-control" type="file" id="imgPokemon" name="imgPokemon">
                    </div>
                    <div class="col-12">
                        <label for="imgPokemon2" class="form-label mb-0">Secondary Image</label>
                        <input class="form-control" type="file" id="imgPokemon2" name="imgPokemon2">
                    </div>
                    <div class="col-md-6">
                        <label for="numberPokemon" class="form-label mb-0">Number</label>
                        <input class="form-control" type="number" id="numberPokemon" name ="numberPokemon">
                    </div>
                    <div class="col-md-6">
                        <label for="category" class="form-label mb-0">Category</label>
                        <input class="form-control" type="text" id="category" placeholder="ex.Penguin Pokemon" name="category">
                    </div>
                    <div class="col-md-6">
                        <label for="height" class="form-label mb-0">Height</label>
                        <input class="form-control" type="number" id="height" name ="height">
                    </div>
                    <div class="col-md-6">
                        <label for="weight" class="form-label mb-0">Weight</label>
                        <input class="form-control" type="number"  id="weight" name ="weight">
                    </div>
                </div>
                <div class="row g-3 movesPokemon">
                    <div class="row">
                        <h2>Moves</h2>
                    </div>
                    <div class="row g-3 move1">
                        <div class="col-12">
                            <label for="fullMove1" class="form-label mb-0">Move 1</label>
                            <select id="fullMove1" class="form-select" name ="fullMove1">
                                <option hidden selected value value="0">Select one move</option>
                                <?php foreach ($moves as $move) { ?>
                                    <option value="<?php echo $move['id']; ?>">
                                        <?php echo $move['nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row g-3 move2">
                        <div class="col-12">
                            <label for="fullMove2" class="form-label mb-0">Move 2</label>
                            <select id="fullMove2" class="form-select" name ="fullMove2">
                                <option hidden selected value value="0">Select one move</option>
                                <?php foreach ($moves as $move) { ?>
                                    <option value="<?php echo $move['id']; ?>">
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
                        <input type="text" class="form-control" id="ilustrator" placeholder="Ilustrator" name="ilustrator">
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="form-label mb-0">Description</label>
                        <input type="text" class="form-control" id="description" placeholder="Description" name="description">
                    </div>
                    <div class="col-md-6">
                        <label for="rarity" class="form-label mb-0">Rarity</label>
                        <select id="rarity" class="form-select" name="rarity">
                            <option hidden selected value>Chose the rarity</option>
                            <option value ="Common">Common</option>
                            <option value ="Uncommon">Uncommon</option>
                            <option value ="Rare">Rare</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="collector-num" class="form-label mb-0">Colector number</label>
                        <input type="number" class="form-control" id="collector-num" placeholder="Number" name="collector-num">
                    </div>
                </div>
                <button type="submit" name ="insert" class="myButton">SAVE</button>
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
</body>

</html>