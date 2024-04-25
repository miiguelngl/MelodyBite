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
function añadirAlCarrito(nombreBurger) {
    let carrito = obtenerCarritoLocalStorage();
    let burger = {
        id: idBurger,
        nombre: nombreBurger
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
        item.textContent = producto.nombre;
        item.appendChild(x);
        listaProductos.appendChild(item);
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

    document.getElementById('total').textContent = `Total: ${total.toFixed(2)}€`;
}


var buttons = document.querySelectorAll(".añadir");
buttons.forEach(button => {
    // Agrega eventos de clic para los demás botones "Añadir" aquí...
    button.addEventListener('click', () => añadirAlCarrito(button.getAttribute('name')));
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
document.getElementById('vaciarCarrito').addEventListener('click', vaciarCarrito);
