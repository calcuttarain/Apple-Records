<?php if (!empty($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>


<p>Te rugăm să îți verifici contul de email pentru link-ul de confirmare.</p>

<form method="POST" action="<?= ROOT ?>/authentication/resendToken">
    <button type="submit">Retrimite link de verificare</button>
</form>

