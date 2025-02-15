<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Band Member Dashboard | Apple Records</title>
    
    <!-- Bootstrap CSS -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../partials/logout_navbar.php'; ?>


<div class="container d-flex flex-column justify-content-center align-items-center text-center mt-5">
    <div class="text-center" style="max-width: 750px;">
        <h1 class="fw-bold text-center">Bine ai venit la Apple Records! </h1>

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

        <p class="fs-5 text-light">
            Într-o lume în care mulți caută succesul, dar puțini îl merită, Apple Records nu oferă promisiuni goale.  
            Nu credem în forme fără fond – muzica adevărată se susține prin talent, muncă și autenticitate,  
            nu prin aparențe sau ambiții lipsite de substanță.  
        </p>

        <p class="fs-6 text-light opacity-75">
            Pentru a colabora cu Apple Records, este necesar să demonstrezi nu doar dorință, ci și valoare.  
            O <strong>cerere de contract</strong> nu este un privilegiu, ci un test al consistenței și al viziunii artistice.  
            Dacă propunerea ta are fundament, vei putea trece mai departe, având acces la lansări,  
            gestionarea albumelor și interacțiunea cu publicul.  
        </p>

        <p class="fs-6 text-light opacity-75 fst-italic">
            „Orice formă fără fond este o ficțiune destinată să se prăbușească.”  
            Aici, nu contează cine ești, ci ceea ce creezi. Apple Records rămâne un spațiu pentru cei care  
            nu doar vor să facă muzică, ci au ceva autentic de spus.  
            <strong>Intră cine vrea, rămâne cine poate.</strong>  
        </p>
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="<?= ROOT ?>/band_member/contractForm" class="btn btn-custom-primary btn-lg shadow-sm">
                <strong>Crează cerere de contract</strong>
            </a>

            <a href="<?= ROOT ?>/band_member/myRequests" class="btn btn-custom-outline btn-lg shadow-sm">
                <strong>Vezi cererile mele</strong>
            </a>
        </div>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

