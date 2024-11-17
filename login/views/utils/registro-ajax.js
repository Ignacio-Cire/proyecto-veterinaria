function handleSubmit(event) {
    event.preventDefault(); // Evita el envío inmediato del formulario.

        const password = document.getElementById("password").value;
        
        // Generar el hash MD5 de la contraseña.
        const hashHex = CryptoJS.MD5(password).toString();
        console.log("Hash MD5:", hashHex);

        // Asigna el hash al campo de entrada de la contraseña.
        document.getElementById("password").value = hashHex;

        const captchaResponse = grecaptcha.getResponse();

    // Verificar que se haya completado el CAPTCHA.
    if (!captchaResponse) {
        mostrarMensaje('Por favor, verifica el CAPTCHA.', 'warning');
        return;
    }

    // Crear FormData para enviar los datos.
    const formData = new FormData();
    formData.append("nombreUsuario", document.getElementById("nombreUsuario").value);
    formData.append("email", document.getElementById("email").value);
    formData.append("password", hashHex);
    formData.append("g-recaptcha-response", captchaResponse);
   // console.log("formData", formData);
    for (let [key, value] of formData) {
        console.log(`${key}: ${value}`)

    }
    // Enviar los datos mediante AJAX.

 

    $.ajax({
        url: '../action/verificarRegistro.php',
        type: 'POST',
        data: formData,
        dataType: 'json',
       // processData: false,
        //contentType: false,
        success: function(response) {
            console.log(response);

            if (response.status === 'success') {
                mostrarMensaje("Registro exitoso");
                window.location.href = '../Login/login.php';
            } else {
                mostrarMensaje("Error en el registro: " + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", status, error);
        }
    });
}

// Asociar el evento 'submit' del formulario.
document.getElementById("miFormulario").addEventListener("submit", handleSubmit);
