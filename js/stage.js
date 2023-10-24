// Obtenemos una referencia al primer select y al segundo select
let stageSelect = document.getElementById("stage");
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

// Simulamos un evento "change" al cargar la página para aplicar el estado inicial
stageSelect.dispatchEvent(new Event("change"));