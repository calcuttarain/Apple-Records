<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Informații despre trupă</title>
</head>
<body>

<?php require __DIR__ . '/../header.view.php'; ?>

<h1>Trupă: <?= htmlspecialchars($bandName) ?></h1>

<?php if (!empty($wikiInfo)): ?>
    <p><?= nl2br(htmlspecialchars($wikiInfo)) ?></p>
<?php else: ?>
    <p>Nu am găsit informații suplimentare despre această trupă pe Wikipedia.</p>
<?php endif; ?>

<p>
    <a href="<?= ROOT ?>/customer">Înapoi la lista de albume</a>
</p>
</body>
</html>

