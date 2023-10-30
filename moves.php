<?php 
     require_once('./php_libraries/bd.php');
     $moves = selectMoves();
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
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/moves.css">
    
</head>

<body>
    
    <nav class="navbar navbar-expand-lg bg-light sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img class="pokeball-logo" src="./img/pokeball.svg" alt="Logo" style="height: 50px; margin-right: 10px;">PokeCardCollector</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-end"  id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">Moves</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <main>
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Damage</th>
                <th>Effect</th>
                <th>Type</th>
    
            </tr>

            
            <?php foreach ($moves as $move) {?>
                    <tr>
                        <td><?php echo $move['nombre']; ?></td>
                        <td><?php echo $move['daño']; ?></td>
                        <td><?php echo $move['efecto']; ?></td>
                        <?php
                            $typeName = selectTypesByID($move['ID_Tipo']);
                        ?>
                        <td>
                            <img src="img/<?php echo strtolower($typeName); ?>-type.png" alt="Move Type" style="height: 20px">
                            <?php echo $typeName ?>
                        </td>
                    </tr>
            <?php } ?>
        </table>
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