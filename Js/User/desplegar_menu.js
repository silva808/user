document.addEventListener('DOMContentLoaded', function () {
    var toggleMenu = document.getElementById('toggleMenu');
    var menuContainer = document.querySelector('.con_menu');
    var closeMenu = document.getElementById('closemenu');

    toggleMenu.addEventListener('change', function () {
        if (toggleMenu.checked) {
            menuContainer.classList.add('menu-abierto');
            menuContainer.style.display='flex';
            menuContainer.style.visibility='visible';
            console.log("chekeado");

        } 
    });

    closeMenu.addEventListener('click', function () {
        toggleMenu.checked = false;
        menuContainer.classList.remove('menu-abierto');
    });
});