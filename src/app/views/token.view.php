<?php if (!empty($_SESSION['error'])): ?>
    <div class="error-message">
        <?= htmlspecialchars($_SESSION['error']); ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
<link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">

<div class="verification-container text-center">
    <p class="verification-text">Te rugăm să îți verifici contul de email pentru link-ul de confirmare.</p>

    <form method="POST" action="<?= ROOT ?>/authentication/resendToken">
        <button type="submit" class="btn btn-custom-register">Retrimite link de verificare</button>
    </form>
</div>

