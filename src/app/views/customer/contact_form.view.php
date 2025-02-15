<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact | Apple Records</title>

    <!-- Bootstrap CSS -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">
    
    <!-- Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../partials/customer_navbar.php'; ?>

<div class="container mt-5">
    <h1 class="text-center mb-4">Contactează Casa de Discuri</h1>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="success-message-1">
            <?= htmlspecialchars($_SESSION['success']); ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="error-message-1">
            <?= htmlspecialchars($_SESSION['error']); ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="contact-form mx-auto p-4 rounded">
        <form action="<?= ROOT ?>/customer/sendContact" method="post" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="subject" class="form-label">Subiect:</label>
                <input type="text" id="subject" name="subject" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Mesaj:</label>
                <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
            </div>

            <!-- Google reCAPTCHA -->
            <div class="mb-3 text-center">
                <div class="g-recaptcha d-inline-block" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-theme="dark"></div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-custom-primary">Trimite</button>
            </div>
        </form>
    </div>

    <div class="text-center mt-4">
        <a href="<?= ROOT ?>/customer" class="btn btn-custom-outline">Înapoi la albume</a>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

