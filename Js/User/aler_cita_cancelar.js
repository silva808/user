        function showAlert(title, message) {
        document.getElementById('alert-title').innerText = title;
        document.getElementById('alert-message').innerText = message;
        document.getElementById('custom-alert').style.display = 'block';
        }

        document.getElementById('close-alert').addEventListener('click', function() {
            document.getElementById('custom-alert').style.display = 'none';
        });

        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('success')) {
                const success = urlParams.get('success');
                console.log(success);
                switch (success) {
                    case '1':
                        showAlert('Solicitud Enviada', 'La solicitud de su cita ha sido enviada. Tendrá respuesta el día de mañana en horas de la mañana.');
                        break;
                    case '3':
                        showAlert('Cita cancelada correctamente', 'Ahora tienes disponible el formulario para agendar otra cita.');
                        break;
                    case '5':
                        showAlert('Ya tienes una cita agendada');
                        break;
                    default:
                        showAlert('Error', 'Hubo un problema al enviar la solicitud. Por favor, inténtelo nuevamente.');
                        break;
                }
                // Limpiar los parámetros de la URL
                window.history.replaceState(null, null, window.location.pathname);
            }
        });

