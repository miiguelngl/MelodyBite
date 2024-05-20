function obtenerCarritoLocalStorage() {
    let carritoJSON = localStorage.getItem('carrito');
    return carritoJSON ? JSON.parse(carritoJSON) : [];
}

// Función para guardar el carrito en el Local Storage
function guardarCarritoLocalStorage(carrito) {
    localStorage.setItem('carrito', JSON.stringify(carrito));
}


function actualizarLista() {
    let lista = document.getElementById("lista");
    lista.innerHTML = '';

    document.getElementById("icon-cart").style.display = 'none';

    let carrito = obtenerCarritoLocalStorage();

    let urlActual = window.location.href;
    if (urlActual.includes("compra")) {
        let tituloPago = document.createElement("h2");
        tituloPago.innerText = 'A un paso de tu bocado';
        lista.appendChild(tituloPago);
    }else{
        let tituloPago = document.createElement("h2");
        tituloPago.innerText = 'Procesando tu último bocado';
        lista.appendChild(tituloPago);
    }
    

    carrito.forEach(burger => {
        let divGenerico= document.createElement("div");
        divGenerico.classList.add("divFilaBurger");

        let divIzq = document.createElement("div");
        divIzq.classList.add("divIzqLista");

        let imgBurger = document.createElement("img");
        imgBurger.src = 'img/Hamburguesas/' + burger.nombre + '.png';
        divIzq.appendChild(imgBurger);

        let divDer = document.createElement("div");
        divDer.classList.add("divDerLista");

        let tituloBurger = document.createElement("h2");
        tituloBurger.innerText = burger.nombre + ' - ' + parseFloat(burger.precio).toFixed(0) + '€';
        divDer.appendChild(tituloBurger);

        const listaUL = document.createElement('ul');
        let ingredientesBurger = burger.ingredientes.split(', ');
        ingredientesBurger.forEach(ingrediente => {
            let listaLI = document.createElement('li');
            listaLI.textContent = ingrediente;
            listaUL.appendChild(listaLI);
        });
        divDer.appendChild(listaUL);

        if (urlActual.includes("compra")) {
            let extra = document.createElement("p");
            extra.innerText = 'Añadir ingrediente';
            extra.id = 'extra';
            divDer.appendChild(extra);
        }

        divGenerico.appendChild(divIzq);
        divGenerico.appendChild(divDer);
        lista.appendChild(divGenerico);
    });

    
    if (urlActual.includes("compra")) {
        let hr = document.createElement('hr');
        lista.appendChild(hr);

        let button = document.createElement('button');
        let a = document.createElement('a');
        a.textContent = 'FINALIZAR COMPRAR';
        a.href = 'checkOut.php';
        button.appendChild(a);
        button.classList.add('finalizarCompra');
        button.id = 'finCompra';
        lista.appendChild(button);

        let divButton= document.createElement("div");
        divButton.classList.add("divButton");
        divButton.appendChild(button);
        lista.appendChild(divButton);
    }
}

//MOSTRAR CARRITO
document.addEventListener('DOMContentLoaded', function() {
    actualizarLista();
});