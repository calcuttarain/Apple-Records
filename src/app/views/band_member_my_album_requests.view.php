<!DOCTYPE html>
<html>
<head>
    <title>Cererile Mele de Album</title>
</head>
<body>

<h1>Cererile mele de Album</h1>

<?php if (!empty($requests)): ?>
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>ID Cerere</th>
            <th>Titlu</th>
            <th>Format</th>
            <th>Notițe</th>
            <th>Status</th>
            <th>Data Creării</th>
        </tr>
        <?php foreach ($requests as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r->id) ?></td>
            <td><?= htmlspecialchars($r->title) ?></td>
            <td><?= htmlspecialchars($r->format) ?></td>
            <td><?= htmlspecialchars($r->notes) ?></td>
            <td><?= htmlspecialchars($r->status) ?></td>
            <td><?= htmlspecialchars($r->created_at) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Nu ai nicio cerere de album încă.</p>
<?php endif; ?>

<p>
    <a href="<?= ROOT ?>/band_member">Înapoi la Dashboard</a>
</p>

</body>
</html>

