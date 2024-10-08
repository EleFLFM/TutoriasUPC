
    function validarContraseña(input) {
        var contraseña = input.value;
        var contraseñaValida = /^(?=.*\d).{8,}$/.test(contraseña);

        if (!contraseñaValida) {
            input.setCustomValidity("La contraseña debe contener al menos 8 caracteres, incluyendo al menos un número.");
        } else {
            input.setCustomValidity("");
        }
    }
