window.addEventListener("load", () => {
    document.querySelector('form').addEventListener('submit', function(event) {
        let valido = true;
        let fallos = "";
        const form = event.target;

        const nick = form.querySelector('input[name="nickname"]').value.trim();
        if (nick === "") {
            valido = false;
            fallos += "El nombre de usuario es obligatorio.\n";
        }

        const nombre = form.querySelector('input[name="name"]').value.trim();
        if (nombre === "") {
            valido = false;
            fallos += "El nombre es obligatorio.\n";
        }

        const apellidos = form.querySelector('input[name="subname"]').value.trim();
        if (apellidos === "") {
            valido = false;
            fallos += "Los apellidos son obligatorios.\n";
        }

        const correo = form.querySelector('input[name="email"]').value.trim();
        if (correo === "") {
            valido = false;
            fallos += "El correo es obligatorio.\n";
        } else if (!/\S+@\S+\.\S+/.test(correo)) {
            valido = false;
            fallos += "El correo no es válido.\n";
        }
    
        const direccion = form.querySelector('input[name="direccion"]').value;
        if (direccion === "") {
            valido = false;
            fallos += "La direccion es obligatoria.\n";
        }

        const contra = form.querySelector('input[name="pass"]').value;
        const recontra = form.querySelector('input[name="re_pass"]').value;
        if (contra.length < 4) {
            valido = false;
            fallos += "La contraseña debe tener al menos 4 caracteres.\n";
        }else if (contra !== recontra) {
            valido = false;
            fallos += "Las contraseñas no coinciden.\n";
        }

        if (!valido) {
            event.preventDefault();
            alert(fallos);
        }
    });
});