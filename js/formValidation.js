// Comprobación de que no tengan el mimsmo movimento los 2 selects de movimientos
document.forms.formPokemon.fullMove1.addEventListener("change", function () 
{
    if (document.forms.formPokemon.fullMove1.value === document.forms.formPokemon.fullMove2.value) {
        alert("A Pokémon cannot have the same move twice.");
        document.forms.formPokemon.fullMove1.selectedIndex = 0; 
    }
});

document.forms.formPokemon.fullMove2.addEventListener("change", function () {
    if (document.forms.formPokemon.fullMove2.value === document.forms.formPokemon.fullMove1.value) 
    {
        alert("A Pokémon cannot have the same move twice.");
        document.forms.formPokemon.fullMove2.selectedIndex = 0;
    }
});

// Select aparece en caso de que el primero tenga como valor Stage1 o 2
let stageSelect = document.forms.formPokemon.stage;
let preevolutionSelect = document.getElementById("preevolution-input");


stageSelect.addEventListener("change", function () {
  
    if (stageSelect.value === "Basic") {
        
        preevolutionSelect.style.display = "none";
    } else {
        
        preevolutionSelect.style.display = "block";
    }
});
stageSelect.dispatchEvent(new Event("change"));


// Guardar img en el preview
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