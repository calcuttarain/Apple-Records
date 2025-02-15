<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Autentificare | Apple Records</title>

    <!-- Bootstrap CSS -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet"> <!-- Fișierul de stiluri -->

</head>
<body class="d-flex align-items-center justify-content-center vh-100">

<?php include __DIR__ . '/partials/general_navbar.php'; ?>

    <div class="login-container">
        <h1 class="text-center">Autentificare</h1>

        <!-- Mesaje de eroare și succes -->
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="error-message text-center fw-bold" role="alert">
                <?= $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success text-center fw-bold" role="alert">
                <?= $_SESSION['success']; ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Formular de Login -->
        <form action="<?= ROOT ?>/authentication/authenticate" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Parolă:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-custom-register w-100">Autentifică-te</button>
        </form>

    </div>

    <!-- Bootstrap JS -->
    <script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

