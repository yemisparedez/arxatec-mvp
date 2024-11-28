document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los campos de contraseña y sus iconos asociados
    const passwordFields = document.querySelectorAll('input[type="password"]');
    const toggleIcons = document.querySelectorAll('.fa-eye, .fa-eye-slash');

    // Ocultar los iconos al inicio
    toggleIcons.forEach(icon => icon.style.display = 'none');

    // Mostrar el icono cuando el usuario comienza a escribir en cada campo de contraseña
    passwordFields.forEach(field => {
        field.addEventListener('input', function() {
            const icon = field.parentNode.querySelector('.fa-eye, .fa-eye-slash');
            icon.style.display = field.value ? 'inline' : 'none';
        });
    });

    // Alternar visibilidad de la contraseña al hacer clic en el icono
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('fa-eye') || event.target.classList.contains('fa-eye-slash')) {
            togglePasswordVisibility(event.target);
        }
    });

    function togglePasswordVisibility(icon) {
        const input = icon.closest('.form-floating').querySelector('input');
        const newType = input.type === 'password' ? 'text' : 'password';
        input.type = newType;

        // Cambiar clase del icono
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    }

    // Verificación de coincidencia de contraseñas
    const confirmPasswordInput = document.getElementById('confirm_password');
    if (confirmPasswordInput) {
        confirmPasswordInput.addEventListener('input', checkPasswordMatch);
    }

    function checkPasswordMatch() {
        const passwordInput = document.getElementById('password');
        const errorDisplay = document.getElementById('password-match-error');

        if (passwordInput.value !== confirmPasswordInput.value) {
            errorDisplay.style.display = 'block';
        } else {
            errorDisplay.style.display = 'none';
        }
    }
});
