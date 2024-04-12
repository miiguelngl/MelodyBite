window.onload(new function() {
    document.addEventListener('DOMContentLoaded', function() {
        const botonAbrir = document.getElementById('header-boton-abrir');
        const botonCerrar = document.getElementById('header-boton-cerrar');
        const menuDesplegable = document.getElementById('header-menu');
        
        botonAbrir.addEventListener('click', function() {
            menuDesplegable.classList.add('active');
        });
        
        botonCerrar.addEventListener('click', function() {
            menuDesplegable.classList.remove('active');
        });
    
        window.addEventListener('click', function(event) {
            const targetElement = event.target;
            const screenWidth = window.innerWidth;
            const clickX = event.clientX;
    
            if (targetElement !== botonAbrir && targetElement !== botonCerrar &&
                clickX < screenWidth * 0.4) {
                menuDesplegable.classList.remove('active');
            }
        });
    });
})
