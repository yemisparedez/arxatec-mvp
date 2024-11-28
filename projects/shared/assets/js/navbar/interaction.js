// Seleccionar todos los elementos del navbar y del sidebar
const navLinks = document.querySelectorAll('.link-item');
const sidebarLinks = document.querySelectorAll('.menu-item a');

// Función para eliminar la clase activa de todas las opciones del navbar
function removeActiveClassesNav() {
    navLinks.forEach(item => {
        item.classList.remove('active-link');
    });
}

// Función para cargar la opción seleccionada desde localStorage (navbar)
function loadActiveNavLink() {
    const currentPage = getCurrentPage(); // Obtén la página actual
    let activeNavLink = localStorage.getItem('activeNavLink');

    // Si no hay una página guardada en localStorage o si la URL no coincide con la página guardada, actualiza
    if (!activeNavLink || activeNavLink !== currentPage) {
        activeNavLink = currentPage;
        localStorage.setItem('activeNavLink', activeNavLink);
    }

    // Marca la opción correspondiente en el navbar
    const activeItem = document.querySelector(`[data-link="${activeNavLink}"]`);
    if (activeItem) {
        activeItem.classList.add('active-link');
    }
}

// Función para obtener la página actual en función de la URL
function getCurrentPage() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('page') || 'dashboard'; // Valor por defecto es 'dashboard'
}

// Agregar un evento de clic a cada opción del navbar
navLinks.forEach(item => {
    item.addEventListener('click', function() {
        removeActiveClassesNav();  // Eliminar la clase activa de todas las opciones del navbar
        this.classList.add('active-link');  // Agregar clase activa a la opción seleccionada
        localStorage.setItem('activeNavLink', this.getAttribute('data-link'));  // Guardar en localStorage
    });
});

// Lógica para el sidebar
sidebarLinks.forEach(item => {
    item.addEventListener('click', function() {
        removeActiveClassesNav();  // Eliminar la clase activa de todas las opciones del navbar
        localStorage.removeItem('activeNavLink');  // Limpiar localStorage para el navbar
    });
});

// Cargar la opción activa al cargar la página para el navbar
loadActiveNavLink();
