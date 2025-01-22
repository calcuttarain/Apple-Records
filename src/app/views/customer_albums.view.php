<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Albume disponibile</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 0 auto; }
        th, td { border: 1px solid #ccc; padding: 8px; }
        th { background: #f5f5f5; }
        h1 { text-align: center; }
    </style>
</head>
<body>

<?php require __DIR__ . '/header.view.php'; ?>

<h1>Albume disponibile la vânzare</h1>

<?php if (!empty($albums)): ?>
    <table>
        <thead>
            <tr>
                <th>Trupă</th>
                <th>Album</th>
                <th>Descriere trupă</th>
                <th>Data lansării</th>
                <th>Format</th>
                <th>Preț (RON)</th>
                <th>Stoc</th>
                <th>Acțiune</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($albums as $album): ?>
            <tr>
                <td><?= htmlspecialchars($album->band_name) ?></td>
                <td><?= htmlspecialchars($album->title) ?></td>
                <td><?= htmlspecialchars($album->band_description) ?></td>
                <td><?= htmlspecialchars($album->release_date) ?></td>
                <td><?= htmlspecialchars($album->format) ?></td>
                <td><?= htmlspecialchars($album->price) ?></td>
                <td><?= htmlspecialchars($album->stock_quantity) ?></td>
                <td>
                    <a href="<?= ROOT ?>/customer/addToCart/<?= $album->id ?>">
                        Cumpără
                    </a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p style="text-align:center;">Momentan nu există albume disponibile.</p>
<?php endif; ?>

</body>
</html>
