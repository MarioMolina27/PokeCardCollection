document.forms.formPokemon.fullMove1.addEventListener("change", function () 
{
    if (document.forms.formPokemon.fullMove1.value === document.forms.formPokemon.fullMove2.value) {
        alert("A Pokémon cannot have the same move twice.");
        document.forms.formPokemon.fullMove1.selectedIndex = 0; // Reiniciar la selección
    }
});

document.forms.formPokemon.fullMove2.addEventListener("change", function () {
    if (document.forms.formPokemon.fullMove2.value === document.forms.formPokemon.fullMove1.value) 
    {
        alert("A Pokémon cannot have the same move twice.");
        document.forms.formPokemon.fullMove2.selectedIndex = 0; // Reiniciar la selección
    }
});

// Obtenemos una referencia al primer select y al segundo select
let stageSelect = document.forms.formPokemon.stage;
let preevolutionSelect = document.getElementById("preevolution-input");

// Escuchamos el evento "change" en el primer select
stageSelect.addEventListener("change", function () {
    // Verificamos si la opción seleccionada es "Basic"
    if (stageSelect.value === "Basic") {
        
        preevolutionSelect.style.display = "none";
    } else {
        
        preevolutionSelect.style.display = "block";
    }
});
stageSelect.dispatchEvent(new Event("change"));


document.forms.formPokemon.imgPokemon.addEventListener("change", function () {
    const [file] = document.forms.formPokemon.imgPokemon.files;
    if (file) {
        document.getElementById('img1Preview').src = URL.createObjectURL(file)
    }
});

document.forms.formPokemon.imgPokemon2.addEventListener("change", function () {
    const [file] = document.forms.formPokemon.imgPokemon2.files;
    if (file) {
        document.getElementById('img2Preview').src = URL.createObjectURL(file)
    }
});