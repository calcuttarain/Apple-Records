<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Înregistrare | Apple Records</title>

    <!-- Bootstrap CSS -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet"> <!-- Fișierul de stiluri inclus -->

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
<?php include __DIR__ . '/partials/general_navbar.php'; ?>


    <div class="register-container">
        <h1 class="text-center"> Înregistrare</h1>

        <!-- Mesaj de eroare -->
        <?php if (!empty($_SESSION['error'])): ?>
            <p class="error-message"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <!-- Formular -->
        <form action="<?= ROOT ?>/authentication/store" method="POST">
            <div class="mb-3">
                <label for="first_name" class="form-label">Prenume:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Nume:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Parolă:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmă parola:</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Tip cont:</label>
                <select name="type" id="type" class="form-select">
                    <option value="customer">Client</option>
                    <option value="band_member">Membru trupă</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <!-- Google reCAPTCHA -->
            <div class="mb-3 text-center">
                <div class="g-recaptcha" data-sitekey="<?= RECAPTCHA_SITE_KEY; ?>" data-theme="dark"></div>
            </div>

            <button type="submit" class="btn btn-custom-register">Înregistrează-te</button>
        </form>

    </div>

    <!-- Bootstrap JS -->
    <script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

