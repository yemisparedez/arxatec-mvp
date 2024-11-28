// Limpiar la URL
document.addEventListener("DOMContentLoaded", function () {
    const currentUrl = window.location.href;
    const cleanUrl = currentUrl.split('index.php')[0];

    window.history.replaceState({}, document.title, cleanUrl);
});
