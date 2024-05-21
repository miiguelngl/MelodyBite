function obtenerCarritoLocalStorage() {
    let carritoJSON = localStorage.getItem('carrito');
    return carritoJSON ? JSON.parse(carritoJSON) : [];
}

// Función para guardar el carrito en el Local Storage
function guardarCarritoLocalStorage(carrito) {
    localStorage.setItem('carrito', JSON.stringify(carrito));
}


function ponerIngrediente(event) {
    let carrito = obtenerCarritoLocalStorage();
    let idBurger = event.target.parentNode.parentNode.dataset.idBurger;
    let divPadre = event.target.parentNode;
    let inputs = divPadre.querySelectorAll("input");
    let extras = [];
    let precioExtra = event.target.dataset.precio;
    let precioTotal = 0;

    inputs.forEach(input => {
        if(input.checked){
            extras.push(input.value);
        }
    });

    if(event.target.checked){
        carrito[idBurger].extras = extras.join(", ");
        precioTotal = parseFloat(carrito[idBurger].precio) + parseFloat(precioExtra);
        carrito[idBurger].precio = precioTotal.toString();
        guardarCarritoLocalStorage(carrito);
    }else{
        carrito[idBurger].extras = extras.join(", ");
        precioTotal = parseFloat(carrito[idBurger].precio) - parseFloat(precioExtra);
        carrito[idBurger].precio = precioTotal.toString();
        guardarCarritoLocalStorage(carrito);
    }

    let precioAct = event.target.parentNode.parentNode.querySelector('h2 span');
    precioAct.innerHTML = precioTotal;
    
}

// Función para quitar ingredientes
function quitarIngredientes(event) {
    event.target.innerHTML = 'Añadir ingredientes';

    let divPadre = event.target.parentNode;
    let divIngredientes = divPadre.querySelector('.divIngredientes');
    let idBurger = divPadre.dataset.idBurger;
    let carrito = obtenerCarritoLocalStorage();
    let precioTotal = parseFloat(carrito[idBurger].precio);

    if (divIngredientes) {
        // Obtener los inputs de ingredientes seleccionados
        let inputs = divIngredientes.querySelectorAll("input:checked");
        
        // Restar el precio de cada ingrediente seleccionado
        inputs.forEach(input => {
            let precioExtra = parseFloat(input.dataset.precio);
            precioTotal -= precioExtra;
        });

        // Actualizar el carrito y guardar en localStorage
        carrito[idBurger].precio = precioTotal.toFixed(2).toString();
        carrito[idBurger].extras = '';
        guardarCarritoLocalStorage(carrito);

        // Remover el contenedor de ingredientes
        divPadre.removeChild(divIngredientes);
    }
    let precioAct = divPadre.querySelector('h2 span');
    precioAct.innerHTML = precioTotal;

    event.target.removeEventListener('click', quitarIngredientes);
    event.target.addEventListener('click', ingredientes);
}

// Función para añadir ingredientes
function ingredientes(event){
    event.target.innerHTML = 'Quitar ingredientes extras';
    var carrito = obtenerCarritoLocalStorage();

    let divPadre = event.target.parentNode;

    let extras = ["Extra de salsa", "Extra de queso", "Que chorree [Extra salsa + Doble queso]"];
    let precios = ["0.50", "0.50", "1.25"];

    let divIngredientes = document.createElement("div");
    divIngredientes.classList.add('divIngredientes');

    let i = 0;
    let extrasBurgerCont = carrito[divPadre.dataset.idBurger].extras.split(", ");

    extras.forEach(extra => {
        let input = document.createElement("input");
        input.type = "checkbox";
        input.name = extra;
        input.value = extra;
        input.dataset.precio = precios[i];

        if(extrasBurgerCont){
            extrasBurgerCont.forEach(element => {
                if(element == extra){
                    input.checked = true;
                }
            });
        }
        
        input.addEventListener('change', ponerIngrediente);

        let label = document.createElement("label");
        label.htmlFor = extra;
        label.innerText = extra + " (+" + precios[i] + "€)";

        divIngredientes.appendChild(input);
        divIngredientes.appendChild(label);
        divIngredientes.appendChild(document.createElement("br"));
        i++;
    });

    divPadre.appendChild(divIngredientes);

    event.target.removeEventListener('click', ingredientes);
    event.target.addEventListener('click', quitarIngredientes);
}


//INGREDIENTES
document.addEventListener('DOMContentLoaded', function() {
    let botonesIng = document.querySelectorAll("#extra");
    botonesIng.forEach(boton => {
        boton.addEventListener('click', ingredientes);
    });
});