<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contact Casa de Discuri</title>
</head>
<body>

<?php require __DIR__ . '/../header.view.php'; ?>


<h1>Contact Casa de Discuri</h1>

<!-- Mesaje de succes/eroare -->
<?php if (!empty($_SESSION['success'])): ?>
    <p style="color: green;">
        <?= htmlspecialchars($_SESSION['success']); ?>
        <?php unset($_SESSION['success']); ?>
    </p>
<?php endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
    <p style="color: red;">
        <?= htmlspecialchars($_SESSION['error']); ?>
        <?php unset($_SESSION['error']); ?>
    </p>
<?php endif; ?>

<form action="<?= ROOT ?>/customer/sendContact" method="post">
    <p>
        <label for="subject">Subiect:</label><br>
        <input type="text" id="subject" name="subject" required style="width:300px;">
    </p>
    <p>
        <label for="message">Mesaj:</label><br>
        <textarea id="message" name="message" rows="5" cols="50" required></textarea>
    </p>
    <p>
        <button type="submit">Trimite</button>
    </p>
</form>

<p>
    <a href="<?= ROOT ?>/customer">Înapoi la albume</a>
</p>

</body>
</html>
