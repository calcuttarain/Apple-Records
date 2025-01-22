<!DOCTYPE html>
<html>
<head>
    <title>Album Requests (Pending)</title>
</head>
<body>

<h1>Album Requests (Pending)</h1>

<?php if (!empty($_SESSION['success'])): ?>
    <p style="color:green;">
        <?= htmlspecialchars($_SESSION['success']) ?>
        <?php unset($_SESSION['success']); ?>
    </p>
<?php endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
    <p style="color:red;">
        <?= htmlspecialchars($_SESSION['error']) ?>
        <?php unset($_SESSION['error']); ?>
    </p>
<?php endif; ?>

<?php if (!empty($requests)): ?>
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>Request ID</th>
            <th>User ID</th>
            <th>Band ID</th>
            <th>Title</th>
            <th>Format</th>
            <th>Notes</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($requests as $req): ?>
            <tr>
                <td><?= htmlspecialchars($req->request_id) ?></td>
                <td><?= htmlspecialchars($req->user_id) ?></td>
                <td><?= htmlspecialchars($req->band_id) ?></td>
                <td><?= htmlspecialchars($req->title) ?></td>
                <td><?= htmlspecialchars($req->format) ?></td>
                <td><?= htmlspecialchars($req->notes) ?></td>
                <td>
                    <form action="<?= ROOT ?>/staff/acceptAlbumRequest/<?= $req->request_id ?>" method="POST" style="display:inline;">
                        <input type="text" name="price" placeholder="Price" style="width:60px;">
                        <input type="text" name="stock_quantity" placeholder="Stock" style="width:60px;">
                        <button type="submit">Accept</button>
                    </form>
                    &nbsp; 
                    <a href="<?= ROOT ?>/staff/rejectAlbumRequest/<?= $req->request_id ?>" 
                       onclick="return confirm('Sigur respingi cererea #<?= $req->request_id ?>?');">
                       Reject
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Nu există cereri de album în pending.</p>
<?php endif; ?>

<p>
    <a href="<?= ROOT ?>/staff">Înapoi la Staff Dashboard</a>
</p>

</body>
</html>

