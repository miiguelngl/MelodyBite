window.onload(new function() {
    document.getElementById("header-boton-abrir").addEventListener("click", function() {
        document.getElementById("header-menu").classList.add("active");
    });
    
    document.getElementById("header-boton-cerrar").addEventListener("click", function() {
        document.getElementById("header-menu").classList.remove("active");
    });
})

