<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apple Records - Acasă</title>
    
    <!-- Bootstrap CSS -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">
    
</head>
<body class="d-flex flex-column min-vh-100">
<?php include __DIR__ . '/partials/general_navbar.php'; ?>

<!-- Hero Section -->
<header class="text-white text-center py-5">
    <div class="container">
        <h1 class="display-4 fw-bold">Bine ai venit la Apple Records</h1>
        <p class="lead opacity-75">Casa de discuri fondată de The Beatles – un simbol al inovației și al creativității muzicale.</p>

        <!-- Logo -->
        <div class="logo-container mt-4">
            <img src="<?= ROOT ?>/public/assets/images/logo.jpg" alt="Apple Records Logo" class="logo-img">
        </div>
    </div>
</header>

<!-- Conținut Principal -->
<div class="text-start mx-auto" style="max-width: 750px;">
        <h2>O casă de discuri revoluționară</h2>
        <p class="fs-5 text-muted">
            <strong>Apple Records</strong> a fost fondată în <strong>1968</strong> de <strong>The Beatles</strong>, din dorința de a avea <strong>control artistic total</strong> asupra muzicii lor și de a sprijini artiști talentați care nu se încadrau în standardele rigide ale industriei muzicale din acea vreme.
        </p>

        <p class="fs-6 text-muted">
            Într-o perioadă în care casele de discuri impuneau reguli stricte, <strong>Apple Records</strong> a devenit un refugiu pentru <strong>experimentare, creativitate și libertate artistică</strong>. Aici, artiștii își puteau exprima viziunea muzicală fără compromisuri.
        </p>

        <h2>Artiști și albume legendare</h2>
        <p class="fs-6 text-muted">
            Pe lângă <strong>The Beatles</strong>, Apple Records a colaborat cu artiști emblematici precum <strong>Mary Hopkin, Badfinger, James Taylor și Billy Preston</strong>.  
            Unele dintre cele mai influente albume din istoria muzicii au fost lansate sub acest label, definind generații și schimbând industria muzicală.
        </p>

        <h2>Semnează contracte și colaborează cu Apple Records</h2>
        <p class="fs-6 text-muted">
            Apple Records oferă oportunități pentru <strong>trupe și artiști noi</strong> de a semna contracte și de a colabora cu muzicieni din întreaga lume.  
            Fie că ești un artist solo sau parte a unei trupe, te poți alătura comunității noastre și îți poți duce muzica la nivel global.
        </p>

        <h2>O moștenire care trăiește și azi</h2>
        <p class="fs-6 text-muted">
            Cu o moștenire care se întinde pe <strong>peste cinci decenii</strong>, Apple Records rămâne un simbol al <strong>muzicii autentice, al inovației și al spiritului liber</strong>.  
            Continuăm să promovăm și să distribuim muzică ce a schimbat generații, păstrând viu spiritul original al <strong>The Beatles</strong>.
        </p>
    </div>
<!-- Butoane -->
<div class="button-container">
    <a href="<?= ROOT ?>/authentication/register" class="btn btn-custom-primary btn-lg shadow-sm"><strong>Înregistrează-te</strong></a>
    <a href="<?= ROOT ?>/authentication/login" class="btn btn-custom-outline btn-lg shadow-sm"><strong>Autentifică-te</strong></a>
</div>

<!-- Statistici -->
<div class="stats-container">
    <p class="small text-muted">
        <?php if (!empty($stats)): ?>
            <strong>Vizitatori pagina:</strong> <strong><?= htmlspecialchars($stats->visitors) ?></strong>
        <?php else: ?>
            <strong>Statistici indisponibile momentan.</strong>
        <?php endif; ?>
    </p>
</div>

<!-- Bootstrap JS -->
<script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

