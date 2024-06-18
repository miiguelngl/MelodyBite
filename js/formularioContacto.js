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

        const apellidos = form.querySelector('input[name="apellidos"]').value.trim();
        if (apellidos === "") {
            valido = false;
            fallos += "Los apellidos son obligatorios.\n";
        }

        const correo = form.querySelector('input[name="correo"]').value.trim();
        if (correo === "") {
            valido = false;
            fallos += "El correo es obligatorio.\n";
        } else if (!/\S+@\S+\.\S+/.test(correo)) {
            valido = false;
            fallos += "El correo no es válido.\n";
        }
    
        const fecha = form.querySelector('input[name="fecha"]').value;
        if (fecha === "") {
            valido = false;
            fallos += "La fecha es obligatoria.\n";
        }
    
        const numPersonas = form.querySelector('input[name="numPersonas"]').value;
        if (numPersonas === "") {
            valido = false;
            fallos += "El número de personas es obligatorio.\n";
        } else if (numPersonas < 1 || numPersonas > 8) {
            valido = false;
            fallos += "El número de personas debe estar entre 1 y 8.\n";
        }
    
        if (!valido) {
            event.preventDefault();
            alert(fallos);
        }
    });
    
});

