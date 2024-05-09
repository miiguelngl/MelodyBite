function cambiarPestaña(pestanya) {
    document.querySelector(".active").classList.remove("active");
    let nameClass = ".case-" + pestanya + "-perfil";
    document.querySelector(nameClass).classList.add("active");
    
}

function cambiarMenu(){
    let listaMenu = document.querySelectorAll(".lista-menu-perfil ul li");

    listaMenu.forEach(lista => {
        lista.addEventListener('click', () => {
            document.querySelector(".active-menu").classList.remove("active-menu");
            lista.classList.add("active-menu");

            cambiarPestaña(lista.dataset.menu);
        });
    });
}

window.addEventListener('load', cambiarMenu);

