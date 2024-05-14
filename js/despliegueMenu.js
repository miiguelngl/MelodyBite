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
    document.addEventListener('DOMContentLoaded', function() {
        const carroAbrir = document.getElementById('icon-cart');
        const carroCerrar = document.getElementById('header-boton-cerrar-2');
        const carroDesplegado = document.getElementById('header-cart');
        
        carroAbrir.addEventListener('click', function() {
            carroDesplegado.classList.add('active-2');
        });
        
        carroCerrar.addEventListener('click', function() {
            carroDesplegado.classList.remove('active-2');
        });
        

        window.addEventListener('click', function(event) {
            const targetElement2 = event.target;
            const screenWidth2 = window.innerWidth;
            const clickX2 = event.clientX;
            
            if (targetElement2 !== carroAbrir && targetElement2 !== carroCerrar &&
                clickX2 < screenWidth2 * 0.7 && event.target.className !== 'añadir') {
                carroDesplegado.classList.remove('active-2');
            }
        });
    });
})
