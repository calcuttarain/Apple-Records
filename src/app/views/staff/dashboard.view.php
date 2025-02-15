<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff Dashboard | Apple Records</title>
    
    <!-- Bootstrap CSS -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../partials/logout_navbar.php'; ?>

<div class="container mt-5">
    <div class="text-center mx-auto" style="max-width: 750px;">
        <h1 class="display-5 fw-bold">Staff Dashboard</h1>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="success-message-1">
                <?= htmlspecialchars($_SESSION['success']); ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['error'])): ?>
            <div class="error-message-1">
                <?= htmlspecialchars($_SESSION['error']); ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <p class="fs-5 text-light mt-3">
            Bine ai venit în echipa Apple Records! Aici poți gestiona cererile trimise de artiști și  
            să asiguri că doar cele mai valoroase talente sunt promovate sub acest label.  
        </p>

        <p class="fs-6 text-light opacity-75">
            Fiecare cerere este un pas către un nou succes muzical. Verifică atent cererile și oferă  
            șansa celor care merită să își lase amprenta în industrie.
        </p>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="<?= ROOT ?>/staff/contractRequests" class="btn btn-custom-primary btn-lg shadow-sm">
                <strong>Cereri de contract</strong>
            </a>

            <a href="<?= ROOT ?>/staff/albumRequests" class="btn btn-custom-outline btn-lg shadow-sm">
                <strong>Cereri de albume</strong>
            </a>
        </div>
    </div>
</div>

<script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

