<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cerere de Contract | Apple Records</title>
    
    <!-- Bootstrap CSS -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">
    
    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../partials/logout_navbar.php'; ?>

<div class="container mt-5">
    <h1 class="text-center text-light mb-4">Cerere de Contract</h1>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="error-message-1">
            <?= htmlspecialchars($_SESSION['error']); ?>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="form-container mx-auto">
        <form action="<?= ROOT ?>/band_member/createContractRequest" method="POST" class="needs-validation" novalidate>

            <!-- 📌 Nume trupă -->
            <div class="mb-3">
                <label for="band_name" class="form-label">Nume Trupă</label>
                <input type="text" name="band_name" id="band_name" class="form-control" required>
            </div>

            <!-- 📌 Email-uri membri -->
            <div class="mb-3">
                <label for="members_emails" class="form-label">Email-urile celorlalți membri</label>
                <textarea name="members_emails" id="members_emails" class="form-control" rows="3" required></textarea>
                <small class="text-muted">Ex: email1@example.com, email2@example.com</small>
            </div>

            <!-- 📌 Link Demo -->
            <div class="mb-3">
                <label for="demo_link" class="form-label">Link Demo (YouTube/SoundCloud etc.)</label>
                <input type="url" name="demo_link" id="demo_link" class="form-control" required>
            </div>

            <div class="recaptcha-container">
                <div class="g-recaptcha" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-theme="dark"></div>
            </div>

            <!-- 📌 Buton Trimitere -->
            <div class="text-center">
                <button type="submit" class="btn btn-custom-primary btn-lg shadow-sm">Trimite Cererea</button>
            </div>
        </form>
    </div>

    <div class="text-center mt-4">
        <a href="<?= ROOT ?>/band_member" class="btn btn-custom-outline">Înapoi la Dashboard</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

