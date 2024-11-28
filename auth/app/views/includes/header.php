<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/img/favicona.png">
    <!-- Biblioteca Iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Estilo CSS -->
    <link rel="stylesheet" href="assets/css/index.css">
    <!-- Scripts Bibliotecas -->
    <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts Js -->
    <script src="assets/js/script.js"></script>
    <script src="assets/js/handlers/title_updater.js"></script>
    <script src="assets/js/handlers/page_handler.js"></script>
    <script src="assets/js/animations/progress_animation.js"></script>
    <script src="assets/js/animations/toggle_password_visibility.js"></script>
    <script>
        // Recargar la página si se navega hacia atrás en el historial
        window.onpageshow = function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        };
    </script>

</head>