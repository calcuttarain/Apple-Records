<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Albume disponibile | Apple Records</title>
    
    <!-- Bootstrap CSS -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet"> <!-- Include styles.css -->
</head>
<body class="bg-dark-custom">
<?php include __DIR__ . '/../partials/customer_navbar.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Albume disponibile la vânzare</h1>

    <?php if (!empty($albums)): ?>
        <div class="row">
            <?php foreach ($albums as $album): ?>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card album-card">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?= htmlspecialchars($album->title) ?></h5>
                            <p class="card-text"><strong>Trupă:</strong> 
                                <a href="<?= ROOT ?>/customer/bandWiki/<?= urlencode($album->band_name) ?>" class="text-light-custom">
                                    <?= htmlspecialchars($album->band_name) ?>
                                </a>
                            </p>
                            <p class="card-text"><strong>Data lansării:</strong> <?= htmlspecialchars($album->release_date) ?></p>
                            <p class="card-text"><strong>Format:</strong> <?= htmlspecialchars($album->format) ?></p>
                            <p class="card-text"><strong>Preț:</strong> <?= htmlspecialchars($album->price) ?> RON</p>
                            <p class="card-text"><strong>Stoc:</strong> <?= htmlspecialchars($album->stock_quantity) ?></p>
                            <a href="<?= ROOT ?>/customer/addToCart/<?= $album->id ?>" class="btn btn-custom-primary">Cumpără</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">Momentan nu există albume disponibile.</p>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="<?= ROOT ?>/customer/contactForm" class="btn btn-custom-outline">Contactează Casa de Discuri</a>
    </div>

    <?php include __DIR__ . '/../partials/footer.php'; ?>
</div>

<!-- Bootstrap JS -->
<script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

