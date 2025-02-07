<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Coșul meu</title>
</head>
<body>

    <?php require __DIR__ . '/../header.view.php'; ?>


    <h1>Coș de cumpărături</h1>

    <?php if (!empty($cartDetails)): ?>
        <table border="1" cellpadding="6" cellspacing="0">
            <tr>
                <th>Trupă</th>
                <th>Album</th>
                <th>Preț unitar</th>
                <th>Cantitate</th>
                <th>Total</th>
            </tr>
            <?php foreach ($cartDetails as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['band_name']) ?></td>
                    <td><?= htmlspecialchars($item['title']) ?></td>
                    <td><?= htmlspecialchars($item['price']) ?> RON</td>
                    <td>
                        <a href="<?= ROOT ?>/customer/decrementQuantity/<?= $item['album_id'] ?>">[-]</a>

                        <?= htmlspecialchars($item['quantity']) ?>

                        <a href="<?= ROOT ?>/customer/incrementQuantity/<?= $item['album_id'] ?>">[+]</a>
                    </td>
                    <td><?= htmlspecialchars($item['item_total']) ?> RON</td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h3>Total coș: <?= htmlspecialchars($total) ?> RON</h3>

        <p>
            <a href="<?= ROOT ?>/customer/checkout">Finalizează comanda</a>
        </p>
    <?php else: ?>
        <p>Coșul este gol.</p>
    <?php endif; ?>

    <p>
        <a href="<?= ROOT ?>/customer">Înapoi la lista de albume</a>
    </p>
</body>
</html>
