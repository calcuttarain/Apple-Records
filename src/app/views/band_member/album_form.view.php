<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cerere de Album</title>

    <!-- Bootstrap & Stiluri -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">


<?php include __DIR__ . '/../partials/logout_navbar.php'; ?>
<div class="container mt-5 text-center">
    <h1 class="fw-bold">Cerere de Album</h1>

    <!-- ✅ Mesaj de eroare -->
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="error-message-1">
            <?= htmlspecialchars($_SESSION['error']); ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <!-- 📌 Formular -->
    <form action="<?= ROOT ?>/band_member/createAlbumRequest" method="POST" class="album-request-form mx-auto">
        
        <div class="mb-3 text-start">
            <label for="title" class="form-label fw-bold">Titlu Album:</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3 text-start">
            <label for="format" class="form-label fw-bold">Format:</label>
            <select name="format" id="format" class="form-select" required>
                <option value="vinyl">Vinyl</option>
                <option value="cassette">Cassette</option>
                <option value="cd">CD</option>
            </select>
        </div>

        <div class="mb-3 text-start">
            <label for="notes" class="form-label fw-bold">Note (opțional):</label>
            <textarea name="notes" id="notes" rows="3" class="form-control"></textarea>
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <button type="submit" class="btn btn-custom-primary">
                <strong>Trimite Cererea</strong>
            </button>
            <a href="<?= ROOT ?>/band_member" class="btn btn-custom-outline">
                <strong>⟵ Înapoi la Dashboard</strong>
            </a>
        </div>
    </form>
</div>

<!-- Bootstrap -->
<script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

