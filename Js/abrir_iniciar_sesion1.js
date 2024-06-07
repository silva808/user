const ini= document.querySelector('#sesion1');
const modal= document.querySelector('.modal');
const closee = document.querySelector('#o_p');

function abrir() {
    modal.style.display = 'flex';
    modal.style.visibility = 'visible';
    document.body.style.overflow = 'hidden';
}
function cerrar() {
    modal.style.display = 'none';
    modal.style.visibility = 'hidden';
    document.body.style.overflow = 'auto';

}
 ini.addEventListener('click', abrir);
closee.addEventListener('click', cerrar);

//--------------cerrar sesion--------- 

const ver=document.querySelector('#user');
const formu= document.querySelector('#cerrarsesion')
const cancel= document.querySelector('#cancell');

function mostrar(){
    formu.style.display='flex';
    formu.style.visibility = 'visible';
}
function nomostrar(){
    formu.style.display='none';
    formu.style.visibility = 'hidden';
}
ver.addEventListener('click',mostrar);
cancel.addEventListener('click',nomostrar);


