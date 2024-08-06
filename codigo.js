document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm");
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");

    // Expresión regular para verificar la seguridad de la contraseña
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    // Validación del correo electrónico en tiempo real
    emailInput.addEventListener("input", function () {
        if (emailInput.validity.valid) {
            emailInput.classList.remove("is-invalid");
        } else {
            emailInput.classList.add("is-invalid");
        }
    });

    // Validación de la contraseña en tiempo real
    passwordInput.addEventListener("input", function () {
        if (passwordRegex.test(passwordInput.value)) {
            passwordInput.classList.remove("is-invalid");
        } else {
            passwordInput.classList.add("is-invalid");
        }
    });

    // Validación del formulario al intentar enviarlo
    form.addEventListener("submit", function (event) {
        if (!emailInput.validity.valid || !passwordRegex.test(passwordInput.value)) {
            event.preventDefault(); // Evita que el formulario se envíe si es inválido
            event.stopPropagation();
        }
    });
});
