 /*codigo scrit para el menu de la hamburgesa que se esconda y aparesca*/
 document.addEventListener('DOMContentLoaded', function() {
        
    var checkbox = document.getElementById('check');
    var menuContainer = document.querySelector('.contenedor_menu');

    //  mostrarmenu cono de la hamburguesa 
    var menuIcon = document.querySelector('.mostrarmenu');
    // esconder  menu la equiz
    var closeIcon = document.querySelector('.escondermenu');

    // agregar eventos a la hamburgesa
    menuIcon.addEventListener('click', function() {
        
        menuContainer.style.left = menuContainer.style.left === '0px' ? '-100%' : '0px';
        checkbox.checked = !checkbox.checked; 
    });

    // Agreggar evento a la equiz
    closeIcon.addEventListener('click', function() {
        // Ocultar el menú desmarcando el checkbox
        checkbox.checked = false;
        menuContainer.style.left = '-100%';
    });
});


document.addEventListener('DOMContentLoaded', function() {
var agendarCitaBtn = document.getElementById('agendarCitaBtn');
var contadorClonaciones = 0;
var clones = [];
var clonacionActiva = false;

agendarCitaBtn.addEventListener('click', function(event) {
    event.preventDefault();

    if (clonacionActiva) {
        // Si la clonación está activa, se ocultan los clones y se reinicia el contador y la lista de clones
        ocultarClones();
        contadorClonaciones = 0;
        clones = [];
        clonacionActiva = false;
        // cambia la imagen del boton por la verde 
        agendarCitaBtn.style.backgroundImage = 'url(imagenes/imagebotton.png)';
    } else {
        // Si la clonación no está activa, se permite clonar
        clonar();
    }
});

function clonar() {
    if (contadorClonaciones >= 2) {
        // Si ya se han clonado dos veces, se activa el modo de clonación
        clonacionActiva = true;
        // cambia la imagen del boton por la roja 
        agendarCitaBtn.style.backgroundImage = 'url(imagenes/boton-menos.png)';
    } else {
        // Si se pueden clonar más veces, se realiza la clonación
        var contenedorCitas = document.getElementById('contenedor_citas');
        var clon = contenedorCitas.cloneNode(true);
        var tipoci = clon.querySelector('#tipoci');
        tipoci.parentNode.removeChild(tipoci);
        var añadir = clon.querySelector('#añadir');
        añadir.parentNode.removeChild(añadir);
        contenedorCitas.parentNode.insertBefore(clon, contenedorCitas.nextSibling);
        clones.push(clon);
        contadorClonaciones++;
    }
}

function ocultarClones() {
    // Ocultar todos los clones
    clones.forEach(function(clon) {
        clon.parentNode.removeChild(clon);
    });
}
});
