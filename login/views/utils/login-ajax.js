
$(document).ready(function () {
    // Evento click para el botón de login
    $('#loginButton').on('click', function () {
        // Obtiene los valores de email y password
        const email = $('#email').val().trim();
        const password = $('#password').val().trim();

        // Validar que los campos no estén vacíos
        if (email === '' || password === '') {
            mostrarMensaje('Por favor, completa todos los campos.', 'danger');
            return;
        }

        // Verificar si el CAPTCHA ha sido completado
        const captchaResponse = grecaptcha.getResponse();
        if (!captchaResponse) {
            mostrarMensaje('Por favor, verifica el CAPTCHA.', 'warning');
            return;
        }

        // Datos para enviar al servidor
        const formData = {
            email: email,
            password: password,
            'g-recaptcha-response': captchaResponse
        };

        // Enviar los datos usando AJAX
        $.ajax({
            url: '../action/verificarLogin.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                if (response.includes('Inicio de sesión exitoso')) {
                    mostrarMensaje('Inicio de sesión exitoso. Redireccionando...', 'success');
                    // Redireccionar después de 2 segundos
                    setTimeout(() => {
                        window.location.href = '../Login/paginaSegura.php';
                    }, 2000);
                } else {
                    mostrarMensaje(response, 'danger');
                }
            },
            error: function (xhr, status, error) {
                mostrarMensaje('Ocurrió un error al procesar tu solicitud. Intenta de nuevo.', 'danger');
                console.error('Error:', error);
            }
        });
    });

    // Función para mostrar mensajes con Bootstrap
    function mostrarMensaje(mensaje, tipo) {
        const alertBox = `
            <div class="alert alert-${tipo} alert-dismissible fade show" role="alert">
                ${mensaje}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        $('#mensaje').html(alertBox);
    }
});
