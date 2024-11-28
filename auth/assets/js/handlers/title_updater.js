// Este script maneja el cambio dinámico del título de la página.
// 1. Al cargar la página, actualiza el título según el valor del parámetro 'page' en la URL (por ejemplo, 'login' o 'register').
// 2. También escucha el evento 'visibilitychange' para detectar cuándo el usuario cambia de pestaña del navegador.
//    - Cuando el usuario sale de la pestaña, el título cambia a "Quédate en ArxaTEC ⚖💔".
//    - Cuando el usuario regresa a la pestaña, se restaura el título original que corresponde a la página actual.


document.addEventListener("DOMContentLoaded", function() {
    // Variable para almacenar el título actual
    let originalTitle = 'Login | ArxaTEC'; // Título predeterminado
    const params = new URLSearchParams(window.location.search);

    // Función para cambiar el título de la página según la URL
    function updateTitle() {
        if (params.has('page')) {
            const page = params.get('page');
            if (page === 'login') {
                originalTitle = 'Login | ArxaTEC';
            } else if (page === 'register') {
                originalTitle = 'Register | ArxaTEC';
            }
            // Puedes agregar más casos si necesitas manejar más páginas
        }
        // Actualizar el título del documento
        document.title = originalTitle;
    }

    // Función para detectar cuando el usuario cambia de pestaña
    function handleVisibilityChange() {
        if (document.visibilityState === 'hidden') {
            // Cambiar título cuando el usuario cambia de pestaña
            document.title = "Quédate en ArxaTEC ⚖💙";
        } else if (document.visibilityState === 'visible') {
            // Restaurar el título cuando regresa a la pestaña
            document.title = originalTitle;
        }
    }

    // Ejecutar la función para actualizar el título al cargar la página
    updateTitle();

    // Escuchar el evento visibilitychange solo cuando se cambia de pestaña
    document.addEventListener('visibilitychange', handleVisibilityChange);
});
