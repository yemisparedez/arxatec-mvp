document.addEventListener("DOMContentLoaded", function() {
    // Selecciona todos los dropdowns que tienen la clase "dropdown-animated"
    const animatedDropdowns = document.querySelectorAll('.dropdown-animated');

    animatedDropdowns.forEach(dropdown => {
        const dropdownMenu = dropdown.querySelector('.dropdown-menu');
        const dropdownContent = dropdownMenu.querySelectorAll('*');

        dropdownMenu.style.transformOrigin = 'top right';

        // Animación al abrir el menú
        dropdown.addEventListener('show.bs.dropdown', function () {
            dropdownMenu.classList.add('animate__animated', 'animate__fadeIn');
            dropdownMenu.style.opacity = '0.3';
            dropdownMenu.style.transform = 'scale(0.7)';
            dropdownContent.forEach(el => el.style.opacity = '0');

            setTimeout(() => {
                dropdownMenu.style.transition = 'transform 0.3s ease-out, opacity 0.3s ease-out';
                dropdownMenu.style.opacity = '1';
                dropdownMenu.style.transform = 'scale(1)';
                dropdownContent.forEach(el => el.style.transition = 'opacity 0.3s ease-out');
                dropdownContent.forEach(el => el.style.opacity = '1');
            }, 10);
        });

        // Animación al cerrar el menú
        dropdown.addEventListener('hide.bs.dropdown', function (event) {
            event.preventDefault();
            dropdownMenu.style.transition = 'transform 0.15s ease-in, opacity 0.1s ease-in';
            dropdownMenu.style.transform = 'scale(0.7)';
            dropdownMenu.style.opacity = '0';
            dropdownContent.forEach(el => el.style.opacity = '0');

            dropdownMenu.classList.add('animate__animated', 'animate__fadeOut');
            dropdownMenu.style.animationDuration = '0.1s';

            setTimeout(() => {
                dropdownMenu.classList.remove('show');
                dropdownMenu.classList.remove('animate__fadeOut');
                dropdownContent.forEach(el => el.style.opacity = '0');
            }, 100);
        });

        dropdownMenu.addEventListener('animationend', () => {
            dropdownMenu.classList.remove('animate__animated', 'animate__fadeIn', 'animate__fadeOut');
        });
    });
});
