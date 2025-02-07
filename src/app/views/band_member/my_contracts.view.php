<!DOCTYPE html>
<html>
<head>
    <title>Cererile mele de contract</title>
</head>
<body>

<?php require __DIR__ . '/../header.view.php'; ?>

<h1>Cererile mele de contract</h1>

<?php if(!empty($requests)): ?>
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>ID Cerere</th>
            <th>Dată creare</th>
            <th>Band Name</th>
            <th>Membri (email)</th>
            <th>Demo Link</th>
            <th>Status</th>
        </tr>
        <?php foreach($requests as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r->id) ?></td>
            <td><?= htmlspecialchars($r->created_at) ?></td>
            <td><?= htmlspecialchars($r->band_name) ?></td>
            <td><?= htmlspecialchars($r->members_emails) ?></td>
            <td><a href="<?= htmlspecialchars($r->demo_link) ?>" target="_blank">Link</a></td>
            <td><?= htmlspecialchars($r->status) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Nu ai trimis nicio cerere de contract încă.</p>
<?php endif; ?>

<p>
    <a href="<?= ROOT ?>/band_member">Înapoi la Band Member Dashboard</a>
</p>

</body>
</html>
