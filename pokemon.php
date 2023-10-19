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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/pokemon.css">
</head>

<body>
    <main class="d-flex align-items-center">
    <img class="pokeball-image" src="./img/pokeball.png" alt="">
        <div class="pokemonEditContainer w-75 p-5">
            <form id="myForm">
                <div class="row g-3 headerPokemon">
                    <div class="row">
                        <h2>Header</h2>
                    </div>
                    <div class="col-md-6">
                        <label for="name" class="form-label mb-0">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Name">
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="form-label mb-0">Type</label>
                        <select id="type" class="form-select">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="stage" class="form-label mb-0">Stage</label>
                        <select id="stage" class="form-select">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="col-6 preevolution-input">
                        <label for="hp" class="form-label mb-0">HP</label>
                        <input type="text" class="form-control" id="hp" placeholder="ex.90">
                    </div>
                    <div class="col-6" hidden>
                        <label for="preevolution" class="form-label mb-0">Preevolution</label>
                        <select id="preevolution" class="form-select">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>

                </div>
                <div class="row g-3 imagePokemon">
                    <div class="row">
                        <h2>Image</h2>
                    </div>
                    <div class="col-12">
                        <label for="formFile" class="form-label mb-0">Image</label>
                        <input class="form-control" type="file" id="formFile">
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="form-label mb-0">Number</label>
                        <input class="form-control" type="number" id="type">
                    </div>
                    <div class="col-md-6">
                        <label for="category" class="form-label mb-0">Category</label>
                        <input class="form-control" type="text" id="category" placeholder="ex.Penguin Pokemon">
                    </div>
                    <div class="col-md-6">
                        <label for="height" class="form-label mb-0">Height</label>
                        <input class="form-control" type="number" step="2" id="height">
                    </div>
                    <div class="col-md-6">
                        <label for="weight" class="form-label mb-0">Weight</label>
                        <input class="form-control" type="number" step="2" id="weight">
                    </div>
                </div>
                <div class="row g-3 movesPokemon">
                    <div class="row">
                        <h2>Moves</h2>
                    </div>
                    <div class="row g-3 move1">
                        <div class="col-md-4">
                            <label for="movetype" class="form-label mb-0">Type</label>
                            <select id="movetype" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="namemove" class="form-label mb-0">Name</label>
                            <input type="text" class="form-control" id="namemove" placeholder="Name">
                        </div>
                        <div class="col-md-4">
                            <label for="damagemove" class="form-label mb-0">Damage</label>
                            <input type="text" class="form-control" id="damagemove" placeholder="Damage">
                        </div>
                        <div class="col-md-12">
                            <label for="effectmove" class="form-label mb-0">Effect</label>
                            <input class="form-control" type="text" id="effectmove">
                        </div>
                    </div>
                    <div class="row g-3 move2">
                        <div class="col-md-4">
                            <label for="movetype2" class="form-label mb-0">Type</label>
                            <select id="movetype2" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="namemove2" class="form-label mb-0">Name</label>
                            <input type="text" class="form-control" id="namemove2" placeholder="Name">
                        </div>
                        <div class="col-md-4">
                            <label for="damagemove2" class="form-label mb-0">Damage</label>
                            <input type="text" class="form-control" id="damagemove2" placeholder="Damage">
                        </div>
                        <div class="col-md-12">
                            <label for="effectmove2" class="form-label mb-0">Effect</label>
                            <input class="form-control" type="text" id="effectmove2">
                        </div>
                    </div>
                </div>
                <div class="row g-3 footerPokemon">
                    <div class="row">
                        <h2>Footer</h2>
                    </div>
                    <div class="col-md-6">
                        <label for="ilustrator" class="form-label mb-0">Ilustrator</label>
                        <input type="text" class="form-control" id="ilustrator" placeholder="Ilustrator">
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="form-label mb-0">Description</label>
                        <input type="text" class="form-control" id="description" placeholder="Description">
                    </div>
                    <div class="col-md-6">
                        <label for="rarity" class="form-label mb-0">Rarity</label>
                        <select id="rarity" class="form-select">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="collector-num" class="form-label mb-0">Colector number</label>
                        <input type="text" class="form-control" id="collector-num" placeholder="Number">
                    </div>
                </div>
                <button type="submit" class="myButton">SAVE</button>
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
</body>

</html>