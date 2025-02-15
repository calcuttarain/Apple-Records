<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <!-- Bootstrap & Stiluri -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../partials/logout_navbar.php'; ?>

<div class="d-flex flex-column justify-content-center align-items-center text-center">
    <h1 class="fw-bold">Admin Dashboard</h1>

    <!-- ✅ Mesaj de succes -->
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success text-center">
            <?= htmlspecialchars($_SESSION['success']); ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger text-center">
            <?= htmlspecialchars($_SESSION['error']); ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="justify-content-center align-items-center text-center d-flex flex-column welcome-message mt-4">
        <p class="fs-5 text-light fw-bold">
            <strong>Administrează cu responsabilitate.</strong>  
            Puterea vine cu responsabilități, iar deciziile tale conturează direcția acestui proiect.  
        </p>
        <p class="fs-6 text-light opacity-75">
            Ai acces la rapoarte detaliate despre activitatea platformei.  
            Transparența și organizarea sunt cheia unui sistem eficient.  
        </p>
    </div>

    <!-- 📌 Butoane de acțiune -->
    <div class="d-flex justify-content-center gap-3 mt-4 flex-wrap">
        <a href="<?= ROOT ?>/admin/downloadActivityExcel" class="btn btn-custom-register btn-lg shadow-sm">
            <strong>📊 Descarcă Raport (CSV)</strong>
        </a>
        <a href="<?= ROOT ?>/admin/downloadActivityXLSX" class="btn btn-custom-register btn-lg shadow-sm">
            <strong>📈 Descarcă Raport (XLSX)</strong>
        </a>
        <a href="<?= ROOT ?>/admin/downloadActivityPDF" class="btn btn-custom-register btn-lg shadow-sm">
            <strong>📄 Descarcă Raport (PDF)</strong>
        </a>
        <a href="<?= ROOT ?>/admin/downloadActivityDOC" class="btn btn-custom-register btn-lg shadow-sm">
            <strong>📝 Descarcă Raport (DOC)</strong>
        </a>
    </div>
</div>

<!-- Bootstrap -->
<script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

