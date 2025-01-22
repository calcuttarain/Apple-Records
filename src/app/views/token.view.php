<form method="POST" action="<?= ROOT ?>/authentication/verifyToken">
    <input type="text" name="token" placeholder="Token" required>
    <button type="submit">Verifică</button>
</form>

<form method="POST" action="<?= ROOT ?>/authentication/resendToken">
    <button type="submit">Retrimite token</button>
</form>

