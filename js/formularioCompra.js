window.addEventListener("load", () => {
    document.querySelector('form').addEventListener('submit', function(event) {
        let valido = true;
        let fallos = "";
        const form = event.target;

        const nombre = form.querySelector('input[name="nombre"]').value.trim();
        if (nombre === "") {
            valido = false;
            fallos += "El nombre es obligatorio.\n";
        }

        const apellido = form.querySelector('input[name="apellido"]').value.trim();
        if (apellido === "") {
            valido = false;
            fallos += "Los apellidos son obligatorios.\n";
        }

        const direccion = form.querySelector('input[name="direccion"]').value.trim();
        if (direccion === "") {
            valido = false;
            fallos += "La dirección es obligatoria.\n";
        }

        const tarjeta = form.querySelector('input[name="tarjeta"]').value.trim();
        if (tarjeta === "") {
            valido = false;
            fallos += "El número de tarjeta es obligatorio.\n";
        } else if (!/^\d{12}$/.test(tarjeta)) {
            valido = false;
            fallos += "El número de tarjeta debe tener 12 dígitos.\n";
        }
    
        const cvv = form.querySelector('input[name="cvv"]').value.trim();
        if (cvv === "") {
            valido = false;
            fallos += "El CVV es obligatorio.\n";
        } else if (!/^\d{3}$/.test(cvv)) {
            valido = false;
            fallos += "El CVV debe tener 3 dígitos.\n";
        }
    
        if (!valido) {
            event.preventDefault();
            alert(fallos);
        }
    });
});

