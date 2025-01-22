<!DOCTYPE html>
<html>
<head>
    <title>Cerere de Contract</title>
</head>
<body>

<h1>Creează Cerere de Contract</h1>

<?php if(!empty($_SESSION['error'])): ?>
    <p style="color:red;">
        <?= htmlspecialchars($_SESSION['error']); ?>
        <?php unset($_SESSION['error']); ?>
    </p>
<?php endif; ?>

<form action="<?= ROOT ?>/band_member/createContractRequest" method="POST">
    <p>
        <label for="band_name">Nume Trupă:</label><br>
        <input type="text" name="band_name" id="band_name" required>
    </p>

    <p>
        <label for="members_emails">Email-urile celorlalți membri:</label><br>
        <textarea name="members_emails" id="members_emails" rows="3" required></textarea>
        <br><small>Ex: email1@example.com, email2@example.com</small>
    </p>

    <p>
        <label for="demo_link">Link Demo (YouTube/SoundCloud etc.):</label><br>
        <input type="url" name="demo_link" id="demo_link" required>
    </p>

    <p>
        <button type="submit">Trimite Cererea</button>
    </p>
</form>

<p>
    <a href="<?= ROOT ?>/band_member">Înapoi la Band Member Dashboard</a>
</p>

</body>
</html>
