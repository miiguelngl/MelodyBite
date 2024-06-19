window.addEventListener("load", () => {
    document.querySelectorAll('form')[3].addEventListener('submit', function(event) {
        let valido = true;
        let fallos = "";
        const form = event.target;

        const contra = form.querySelector('input[name="newcontrasenya"]').value;
        const recontra = form.querySelector('input[name="recontrasenya"]').value;
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