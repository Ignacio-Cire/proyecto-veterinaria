

// Manejo del envío del formulario
$('#miFormulario').submit(function (e) {
    e.preventDefault(); // Previene el envío automático del formulario

    // Captura los valores de los campos del formulario
    const nombreUsuario = $('#nombreUsuario').val().trim();
    const email = $('#email').val().trim();
    const password = $('#password').val().trim();
    const recaptchaResponse = grecaptcha.getResponse(); // Captura la respuesta del reCAPTCHA

    // Validación básica: Verifica que los campos no estén vacíos
    if (nombreUsuario === "" || email === "" || password === "") {
        alert("Debe completar todos los campos.");
        return;
    }

    // Validación del reCAPTCHA: Verifica que el usuario haya completado el reCAPTCHA
    if (recaptchaResponse === "") {
        alert("Debe completar el reCAPTCHA.");
        return;
    }

    // Creación del objeto de datos para enviar
    const datos = {
        nombreUsuario: nombreUsuario,
        email: email,
        password: password, // Se envía la contraseña tal cual (sin encriptar, aunque sería mejor encriptarla en el backend)
        recaptchaResponse: recaptchaResponse
    };

    // Petición AJAX para enviar los datos al servidor
    $.ajax({
        type: "POST",
        url: '../action/verificarRegistro.php',
        data: datos,
        success: function (response) {
            console.log("Respuesta del servidor:", response);
            try {
                const res = JSON.parse(response);
                // Si el registro es exitoso
                if (res.success) {
                    alert("Registro exitoso. Redirigiendo al inicio de sesión...");
                    window.location.href = "../Login/login.php";
                } else {
                    // Mensaje de error proporcionado por el backend
                    alert(res.message || "No se pudo concretar el registro.");
                }
            } catch (error) {
                alert("Error procesando la respuesta del servidor.");
                console.error(error);
            }
        },
        error: function (xhr, status, error) {
            // Manejo de errores en la petición AJAX
            alert("Hubo un error en el registro. Intente nuevamente más tarde.");
            console.error("Error:", error);
        }
    });
});
