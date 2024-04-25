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
function añadirAlCarrito(nombre) {
    let carrito = obtenerCarritoLocalStorage();
    carrito.push(nombre); // Añadir nombre de la hamburguesa al carrito
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
        x.innerText = "X";
        x.id = 'eliminar';
        item.textContent = producto;
        item.appendChild(x);
        listaProductos.appendChild(item);
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
}

// Captura el clic en el botón "Vaciar Carrito" y llama a la función para vaciarlo
document.getElementById('vaciarCarrito').addEventListener('click', vaciarCarrito);

// window.onload(function() {
//     var xs = document.querySelectorAll("#eliminar");
//     xs.forEach(x => {
//         x.addEventListener('click', () => localStorage.removeItem('carrito'));
//     });
// });