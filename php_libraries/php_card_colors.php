<?php
function getHexColor($type) {
    $type = strtolower($type); 

    switch ($type) {
        case "normal":
            return "#CFCFCF";
        case "water":
            return "#65b9e3";
        case "fire":
            return "#fd7d24";
        case "grass":
            return "#78c850";
        case "electric":
            return "#f7d02c";
        case "ice":
            return "#96d9d6";
        case "fighting":
            return "#d56723";
        case "poison":
            return "#a040a0";
        case "ground":
            return "#e0c068";
        case "flying":
            return "#a890f0";
        case "psychic":
            return "#f85888";
        case "bug":
            return "#a8b820";
        case "rock":
            return "#b8a038";
        case "ghost":
            return "#705898";
        case "steel":
            return "#b8b8d0";
        case "dragon":
            return "#7038f8";
        case "dark":
            return "#705848";
        case "fairy":
            return "#ee99ac";
        default:
            return "#000000"; 
    }
}

?>