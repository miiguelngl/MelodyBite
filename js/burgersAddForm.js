function obtenerCarritoLocalStorage() {
    let carritoJSON = localStorage.getItem('carrito');
    return carritoJSON ? JSON.parse(carritoJSON) : [];
}

document.addEventListener('DOMContentLoaded', function() {
    let carrito = obtenerCarritoLocalStorage();
    let hamburguesasPedido = new Array();

    carrito.forEach(burger => {
        if(burger.extras != null){
            hamburguesasPedido.push(burger.nombre + ' - ' + burger.extras);
        }else hamburguesasPedido.push(burger.nombre);
    });

    var formulario = document.forms[0];
    var celdaBurgers = formulario.elements["hamburguesas"];

    celdaBurgers.value = hamburguesasPedido.join(", ");
});