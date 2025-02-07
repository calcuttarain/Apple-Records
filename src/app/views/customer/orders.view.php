<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Comenzile mele</title>
</head>
<body>

<?php require __DIR__ . '/../header.view.php'; ?>

    <h1>Comenzile mele</h1>

    <?php if(!empty($orders)): ?>
        <table border="1" cellpadding="6" cellspacing="0">
            <tr>
                <th>ID Comandă</th>
                <th>Data</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
            <?php foreach($orders as $order): ?>
                <tr>
                    <td><?= htmlspecialchars($order->id) ?></td>
                    <td><?= htmlspecialchars($order->order_date) ?></td>
                    <td><?= htmlspecialchars($order->status) ?></td>
                    <td><?= htmlspecialchars($order->total_amount) ?> RON</td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Nu ai comenzi efectuate.</p>
    <?php endif; ?>

    <p><a href="<?= ROOT ?>/customer">Înapoi la liste de albume</a></p>
</body>
</html>
