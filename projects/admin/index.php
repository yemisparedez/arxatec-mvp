<?php
include '../../auth/middleware/session_check.php';
include 'app/views/core/router.php';
include 'app/views/includes/header.php';

// Capturar la página actual
$page = getCurrentPage();
?>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Incluir el sidebar -->
            <?php include 'app/views/includes/sidebar.php'; ?>

            <!-- Layout container -->
            <div class="layout-page">

                <?php include 'app/views/includes/navbar.php'; ?>

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <?php
                    // Mostrar la página correspondiente
                    renderPage($page);
                    ?>

                    <!-- / Content -->

                    <?php include 'app/views/includes/footer.php'; ?>

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <?php include 'app/views/includes/scripts.php'; ?>

</body>