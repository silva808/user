let slideIndex = 0;
showSlide(slideIndex); // Inicializa el primer slide

function changeSlide(n) {
let slides = document.querySelectorAll('.contain_slider');
// Inicia la transición de desvanecimiento del slide actual
slides[slideIndex].style.opacity = 0;
// slides[slideIndex].style.visibility = 'hidden';
slides[slideIndex].style.display = 'none';
slides[slideIndex].style.transition = 'opacity 0.5s, visibility 0s 0.5s'; // Aplica transición

// Calcula el nuevo índice de slide
slideIndex += n;
if (slideIndex >= slides.length) { slideIndex = 0; }
if (slideIndex < 0) { slideIndex = slides.length - 1; }

//pequeño retraso para permitir que la transición de opacidad termine
setTimeout(() => {
    showSlide(slideIndex);
}, 500); // Alineado con la duración de la transición*/
}

function showSlide(n) {
let slides = document.querySelectorAll('.contain_slider');
// Asegura que todos los slides estén ocultos y sin opacidad antes de mostrar el nuevo
for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = 'none';
    slides[i].style.opacity = 0;
}

// Hace visible el slide activo y comienza la transición de opacidad
slides[n].style.display = 'flex';
slides[n].style.visibility = 'visible';
slides[n].style.opacity = 1;
slides[n].style.transition = 'opacity 5s'; // Transición suave para la opacidad
}