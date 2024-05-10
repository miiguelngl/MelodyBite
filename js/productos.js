let idBurger = 0;
// Función para obtener el carrito del Local Storage
function obtenerCarritoLocalStorage() {
    let carritoJSON = localStorage.getItem('carrito');
    return carritoJSON ? JSON.parse(carritoJSON) : [];
}

// Función para guardar el carrito en el Local Storage
function guardarCarritoLocalStorage(carrito) {
    localStorage.setItem('carrito', JSON.stringify(carrito));
}

// Función para añadir hamburguesa al carrito
function añadirAlCarrito(nombreBurger, precioBurger, ingredientesBurger) {
    let carrito = obtenerCarritoLocalStorage();
    let burger = {
        id: idBurger,
        nombre: nombreBurger,
        precio: precioBurger,
        ingredientes: ingredientesBurger
    };
    idBurger++;
    carrito.push(burger); // Añadir nombre de la hamburguesa al carrito
    guardarCarritoLocalStorage(carrito); // Guardar el carrito en el Local Storage
    actualizarCarrito(); // Actualizar la visualización del carrito
}

function actualizarIDs(carrito){
    idBurger = 0;
    carrito.forEach(burger => {
        burger.id = idBurger;
        idBurger++;
    });
}

function eliminarProducto(idProducto){
    console.log("e");
    // let id = element.getAttribute('name');
    let carrito = obtenerCarritoLocalStorage();
    carrito.splice(idProducto, 1);
    actualizarIDs(carrito);
    guardarCarritoLocalStorage(carrito); // Guardar el carrito en el Local Storage
    actualizarCarrito(); // Actualizar la visualización del carrito
}
// Función para actualizar la visualización del carrito
function actualizarCarrito() {
    let listaProductos = document.getElementById('lista-productos');
    let total = 0;

    listaProductos.innerHTML = ''; // Limpiar la lista de productos antes de actualizar

    let carrito = obtenerCarritoLocalStorage();

    carrito.forEach(producto => {
        let item = document.createElement('li');
        let x = document.createElement("span");
        x.innerHTML = '<svg fill="#000000" height="16px" width="16px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 460.775 460.775" xml:space="preserve"><path fill="#e5d4d4" d="M285.08,230.397L456.218,59.27c6.076-6.077,6.076-15.911,0-21.986L423.511,4.565c-2.913-2.911-6.866-4.55-10.992-4.55c-4.127,0-8.08,1.639-10.993,4.55l-171.138,171.14L59.25,4.565c-2.913-2.911-6.866-4.55-10.993-4.55c-4.126,0-8.08,1.639-10.992,4.55L4.558,37.284c-6.077,6.075-6.077,15.909,0,21.986l171.138,171.128L4.575,401.505c-6.074,6.077-6.074,15.911,0,21.986l32.709,32.719c2.911,2.911,6.865,4.55,10.992,4.55c4.127,0,8.08-1.639,10.994-4.55l171.117-171.12l171.118,171.12c2.913,2.911,6.866,4.55,10.993,4.55c4.128,0,8.081-1.639,10.992-4.55l32.709-32.719c6.074-6.075,6.074-15.909,0-21.986L285.08,230.397z"/></svg>';
        x.id = 'eliminar';
        x.setAttribute('name', producto.id);
        item.textContent = producto.nombre + " - " + producto.precio + "€";
        item.appendChild(x);
        listaProductos.appendChild(item);
        total += parseFloat(producto.precio);
    });

    var xs = document.querySelectorAll("#eliminar");
    // Agregar el evento 'click' a cada ícono de eliminación
    xs.forEach(x => {
        x.addEventListener('click', function() {
            // Obtener el ID del producto que se desea eliminar del atributo 'name' del ícono
            let idProducto = parseInt(this.getAttribute('name'));
            eliminarProducto(idProducto); // Llama a la función eliminarProducto con el ID del producto
        });
    });

    document.getElementById('total').textContent = `Total: ${parseFloat(total).toFixed(2)}€`;
}


var buttons = document.querySelectorAll(".añadir");
buttons.forEach(button => {
    // Agrega eventos de clic para los demás botones "Añadir" aquí...
    button.addEventListener('click', () => añadirAlCarrito(button.getAttribute('name'), button.dataset.precio, button.parentElement.parentElement.firstElementChild.firstChild.firstChild.dataset.ingredientes));
});

// Al cargar la página, actualizar el carrito
window.addEventListener('load', actualizarCarrito);

// Función para vaciar el carrito
function vaciarCarrito() {
    localStorage.removeItem('carrito'); // Elimina el carrito del Local Storage
    actualizarCarrito(); // Actualiza la visualización del carrito
    idBurger = 0;
}

// Captura el clic en el botón "Vaciar Carrito" y llama a la función para vaciarlo
if(document.getElementById('vaciarCarrito')){
    document.getElementById('vaciarCarrito').addEventListener('click', vaciarCarrito);
}


//VENTANA EMERGENTE
document.addEventListener('DOMContentLoaded', function() {

    // document.getElementById("icon-cart").addEventListener('click', function() {
    //     let carrito = obtenerCarritoLocalStorage();
    //     if(carrito == null){
    //         document.getElementById("continuar").style.display = 'none';
    //     }else document.getElementById("continuar").style.display = 'block';
    // });

    const lupa = document.querySelectorAll('#lupa');

    lupa.forEach(function(lupaItem) {
        lupaItem.addEventListener('click', function() {
            const nombre = lupaItem.dataset.nombre;
            const descripcion = lupaItem.dataset.descripcion;
            const precio = lupaItem.dataset.precio;
            const imagenSrc = 'img/Hamburguesas/' + nombre + '.png';

            const ventanaEmergente = document.createElement('div');
            ventanaEmergente.classList.add('ventana-burger');

            const contenidoVentana = document.createElement('div');
            contenidoVentana.classList.add('contenido-burger');

            const contenidoPrincipalVentana = document.createElement('div');
            contenidoPrincipalVentana.classList.add('contenido-principal-burger');

            const botonCerrarVentana = document.createElement('span');
            botonCerrarVentana.classList.add('cerrar');
            botonCerrarVentana.innerHTML = `
                <svg fill="#FEBD01" height="30px" width="30px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 460.775 460.775" xml:space="preserve">
                    <path fill="#FEBD01" d="M285.08,230.397L456.218,59.27c6.076-6.077,6.076-15.911,0-21.986L423.511,4.565c-2.913-2.911-6.866-4.55-10.992-4.55
                        c-4.127,0-8.08,1.639-10.993,4.55l-171.138,171.14L59.25,4.565c-2.913-2.911-6.866-4.55-10.993-4.55
                        c-4.126,0-8.08,1.639-10.992,4.55L4.558,37.284c-6.077,6.075-6.077,15.909,0,21.986l171.138,171.128L4.575,401.505
                        c-6.074,6.077-6.074,15.911,0,21.986l32.709,32.719c2.911,2.911,6.865,4.55,10.992,4.55c4.127,0,8.08-1.639,10.994-4.55
                        l171.117-171.12l171.118,171.12c2.913,2.911,6.866,4.55,10.993,4.55c4.128,0,8.081-1.639,10.992-4.55l32.709-32.719
                        c6.074-6.075,6.074-15.909,0-21.986L285.08,230.397z"/>
                </svg>
            `;

            const imagenHamburguesa = document.createElement('img');
            imagenHamburguesa.src = imagenSrc;
            imagenHamburguesa.alt = 'Imagen de la hamburguesa ' + nombre;

            const contenidoPrincipalVentanaText = document.createElement('div');
            contenidoPrincipalVentanaText.classList.add('contenido-principal-burger-text');

            const nombreHamburguesa = document.createElement('h2');
            nombreHamburguesa.textContent = nombre;

            const descripcionHamburguesa = document.createElement('p');
            descripcionHamburguesa.textContent = descripcion;

            const precioHamburguesa = document.createElement('p');
            precioHamburguesa.textContent = 'Precio: ' + precio + '€';
            precioHamburguesa.id = 'contenido-precio';

            const botonHamburguesa = document.createElement('button');
            botonHamburguesa.textContent = 'La quiero';
            botonHamburguesa.classList.add('añadir');
            botonHamburguesa.id = 'comprar';
            botonHamburguesa.dataset.precio = precio;
            botonHamburguesa.setAttribute('name', nombre);
            botonHamburguesa.addEventListener('click', () => añadirAlCarrito(botonHamburguesa.getAttribute('name'), botonHamburguesa.dataset.precio));

            contenidoPrincipalVentana.appendChild(botonCerrarVentana);
            contenidoPrincipalVentana.appendChild(imagenHamburguesa);
            contenidoPrincipalVentanaText.appendChild(nombreHamburguesa);
            contenidoPrincipalVentanaText.appendChild(descripcionHamburguesa);
            contenidoPrincipalVentanaText.appendChild(precioHamburguesa);
            contenidoPrincipalVentanaText.appendChild(botonHamburguesa);
            contenidoPrincipalVentana.appendChild(contenidoPrincipalVentanaText);
            contenidoVentana.appendChild(contenidoPrincipalVentana);

            const separador = document.createElement('hr');
            contenidoVentana.appendChild(separador);

            const listaIngredientesTittle = document.createElement('h2');
            listaIngredientesTittle.textContent = 'Ingredientes';
            contenidoVentana.appendChild(listaIngredientesTittle);
            
            const ingredientes = lupaItem.previousElementSibling.dataset.ingredientes;
            const ingredientesArray = ingredientes.split(', ');
            const listaUL = document.createElement('ul');
            ingredientesArray.forEach(ingrediente => {
                let listaLI = document.createElement('li');
                listaLI.textContent = ingrediente;
                listaUL.appendChild(listaLI);
            });
            contenidoVentana.appendChild(listaUL);

            ventanaEmergente.appendChild(contenidoVentana);
            document.body.appendChild(ventanaEmergente);

            ventanaEmergente.style.display = 'flex';
            ventanaEmergente.style.alignItems = 'center';
            ventanaEmergente.style.justifyContent = 'center';

            botonCerrarVentana.addEventListener('click', function() {
                ventanaEmergente.remove();
            });
        });
    });
});
