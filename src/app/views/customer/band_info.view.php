<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($bandName) ?> | Apple Records</title>

    <!-- Bootstrap CSS -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
<?php include __DIR__ . '/../partials/customer_navbar.php'; ?>

    <main class="container mt-5 flex-grow-1">
        <div class="text-center mb-4">
            <h1 class="fw-bold"><?= htmlspecialchars($bandName) ?></h1>
        </div>

        <?php if (!empty($wikiInfo) && is_array($wikiInfo)): ?>
            <div class="row align-items-center">
                <!-- Coloană pentru imagine -->
                <?php if (!empty($wikiInfo['imagine'])): ?>
                    <div class="col-md-5 text-center">
                        <div class="band-image-container shadow-lg rounded p-2">
                            <img class="img-fluid rounded" src="<?= htmlspecialchars($wikiInfo['imagine']) ?>" alt="Imagine trupă">
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Coloană pentru text -->
                <div class="col-md-7">
                    <?php if (isset($wikiInfo['rezumat_procesat'])): ?>
                        <p class="fs-5 text-light"><?= nl2br($wikiInfo['rezumat_procesat']) ?></p>
                    <?php else: ?>
                        <p class="text-danger">Nu am găsit informații relevante despre această trupă pe Wikipedia.</p>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <p class="text-danger text-center">Nu am găsit informații suplimentare despre această trupă pe Wikipedia.</p>
        <?php endif; ?>

        <!-- Buton Înapoi -->
        <div class="text-center mt-4">
            <a href="<?= ROOT ?>/customer" class="btn btn-custom-primary shadow-sm px-4 py-2">Înapoi la lista de albume</a>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>

