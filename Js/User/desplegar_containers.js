//Permite cambiar los contenedore
// Obtener referencias a los enlaces y sections
const sections = {
    notificacion: document.querySelector('#prueba'),
    historia_clinica: document.querySelector('#prueba2'),
    add_cita: document.querySelector('#agregar_cita'),
    estado_cita: document.querySelector('#estadocita'),
};

const links = {
    notificacion: document.querySelector('#notificacion'),
    historia_clinica: document.querySelector('#historia_clinica'),
    add_cita: document.querySelector('#add_cita'),
    estado_cita: document.querySelector('#estado_cita')
};

// Función para mostrar una sección y ocultar las demás
function showSection(activeSection) {
    for (let section in sections) {
        if (section === activeSection) {
            sections[section].style.display = 'flex';
            sections[section].style.visibility = 'visible';
        } else {
            sections[section].style.display = 'none';
            sections[section].style.visibility = 'hidden';
        }
    }
}

// Agregar eventos a los enlaces
links.notificacion.addEventListener('click', () => showSection('notificacion'));
links.historia_clinica.addEventListener('click', () => showSection('historia_clinica'));
links.add_cita.addEventListener('click', () => showSection('add_cita'));
links.estado_cita.addEventListener('click', () => showSection('estado_cita'));

// Por defecto, mostramos la sección de Agendar citas al cargar la página
showSection('add_cita');
