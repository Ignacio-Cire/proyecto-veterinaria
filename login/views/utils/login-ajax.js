// Manejo del envío del formulario
$('#loginForm').submit(function (e) {
    e.preventDefault(); // Previene el envío automático del formulario

    // Captura los valores de los campos del formulario
    const email = $('#email').val().trim();
    const password = $('#password').val().trim();
    // const recaptchaResponse = grecaptcha.getResponse(); // Captura la respuesta del reCAPTCHA

    // Validación básica: Verifica que los campos no estén vacíos
    if (email === "" || password === "") {
        alert("Debe completar todos los campos.");
        return;
    }

    // // Validación del reCAPTCHA: Verifica que el usuario haya completado el reCAPTCHA
    // if (recaptchaResponse === "") {
    //     alert("Debe completar el reCAPTCHA.");
    //     return;
    // }

    // Genera el hash MD5 de la contraseña (puedes mantener la parte de MD5 si es el proceso que ya estás usando en la base de datos)
    const hashedPassword = CryptoJS.MD5(password).toString();

    // Creación del objeto de datos para enviar
    const datos = {
        email: email,
        password: hashedPassword, // Envía la contraseña hasheada
        // recaptchaResponse: recaptchaResponse
    };

    // Petición AJAX para enviar los datos al servidor
    $.ajax({
        type: "POST",
        url: '../action/verificarLogin.php',
        data: datos,
        success: function (response) {
            try {   
                const res = JSON.parse(response);

                // Si el login es exitoso
                if (res.success) {
                    alert("Inicio de sesión exitoso.");
                
                    window.location.href = "../Login/paginaSegura.php";
                } else {
                    // Mensaje de error proporcionado por el backend
                    alert(res.message || "No se pudo iniciar sesión.");
                }
            } catch (error) {
                alert("Error procesando la respuesta del servidor.");
                console.error(error);
            }
        }
       
    });
});