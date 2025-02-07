<!DOCTYPE html>
<html>
<head>
    <title>Cerere de Album</title>
</head>
<body>

<h1>Cerere de Album</h1>

<?php require __DIR__ . '/../header.view.php'; ?>

<?php if(!empty($_SESSION['error'])): ?>
    <p style="color:red;">
        <?= htmlspecialchars($_SESSION['error']); ?>
        <?php unset($_SESSION['error']); ?>
    </p>
<?php endif; ?>

<form action="<?= ROOT ?>/band_member/createAlbumRequest" method="POST">

    <p>
        <label for="title">Titlu Album:</label><br>
        <input type="text" name="title" id="title" required>
    </p>

    <p>
        <label for="format">Format:</label><br>
        <select name="format" id="format" required>
            <option value="vinyl">Vinyl</option>
            <option value="cassette">Cassette</option>
            <option value="cd">CD</option>
        </select>
    </p>

    <p>
        <label for="notes">Note (opțional):</label><br>
        <textarea name="notes" id="notes" rows="3"></textarea>
    </p>

    <p>
        <button type="submit">Trimite Cererea</button>
    </p>
</form>

<p>
    <a href="<?= ROOT ?>/band_member">Înapoi la Dashboard</a>
</p>

</body>
</html>
