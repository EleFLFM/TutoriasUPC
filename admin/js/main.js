
    function validarContraseña(input) {
        var contraseña = input.value;
        var contraseñaValida = /^(?=.*\d)(?=.*[A-Z])(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/.test(contraseña);

        if (!contraseñaValida) {
            input.setCustomValidity("La contraseña debe contener al menos 8 caracteres, incluyendo al menos una mayúscula, un número y un carácter especial.");
        } else {
            input.setCustomValidity("");
        }
    }
