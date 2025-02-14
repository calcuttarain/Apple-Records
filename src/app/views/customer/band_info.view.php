<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Informații despre trupă</title>
</head>
<body>

<?php require __DIR__ . '/../header.view.php'; ?>

<h1>Trupă: <?= htmlspecialchars($bandName) ?></h1>

<?php if (!empty($wikiInfo) && is_array($wikiInfo)): ?>
    <?php if (isset($wikiInfo['rezumat_procesat'])): ?>
        <p><?= nl2br($wikiInfo['rezumat_procesat']) ?></p>

        <?php if (!empty($wikiInfo['imagine'])): ?>
            <img class="band-image" src="<?= htmlspecialchars($wikiInfo['imagine']) ?>" alt="Imagine trupă">
        <?php endif; ?>

    <?php else: ?>
        <p>Nu am găsit informații relevante despre această trupă pe Wikipedia.</p>
    <?php endif; ?>
<?php else: ?>
    <p>Nu am găsit informații suplimentare despre această trupă pe Wikipedia.</p>
<?php endif; ?>


<p>
    <a href="<?= ROOT ?>/customer">Înapoi la lista de albume</a>
</p>

</body>
</html>

