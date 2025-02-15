<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Membru de Trupă</title>

    <!-- Bootstrap & Stiluri -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../partials/logout_navbar.php'; ?>

<div class="container mt-5 text-center">
    <h1 class="fw-bold">Dashboard Membru de Trupă</h1>

    <!-- ✅ Mesaj de succes -->
    <?php if (!empty($_SESSION['success'])): ?>
        <div class="success-message-1">
            <?= htmlspecialchars($_SESSION['success']); ?>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <!-- ❌ Mesaj de eroare -->
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="error-message-1">
            <?= htmlspecialchars($_SESSION['error']); ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- 📌 Mesaj de întâmpinare -->
    <div class="welcome-message mt-4">
        <p class="fs-5 text-light fw-bold">
            <strong>Un contract nu este un scop în sine, ci doar începutul.</strong>  
            Mulți pot obține un loc aici, dar doar cei cu adevărat dedicați rămân.  
        </p>
        <p class="fs-6 text-light opacity-75">
            Ai acum platforma necesară pentru a-ți transforma creațiile în <strong>realitate</strong>.  
            Într-o industrie în care <strong>fondul</strong> contează mai mult decât <strong>forma</strong>,  
            te încurajăm să creezi <strong>muzică autentică</strong>, care să reziste în timp.  
        </p>
        <p class="fs-6 text-light opacity-75 fst-italic">
            <strong>Fii mai mult decât un nume pe un contract. Fii un artist care lasă o moștenire.</strong>  
        </p>
    </div>

    <!-- 📌 Butoane de acțiune -->
    <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="<?= ROOT ?>/band_member/albumForm" class="btn btn-custom-primary btn-lg shadow-sm">
            <strong>Crează cerere de album</strong>
        </a>
        <a href="<?= ROOT ?>/band_member/myAlbumRequests" class="btn btn-custom-outline btn-lg shadow-sm">
            <strong>Vezi cererile mele</strong>
        </a>
    </div>
</div>

<!-- Bootstrap -->
<script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

