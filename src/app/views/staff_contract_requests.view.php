<!DOCTYPE html>
<html>
<head>
    <title>Contract Requests (Pending)</title>
</head>
<body>

<h1>Contract Requests (Pending)</h1>

<?php if(!empty($_SESSION['success'])): ?>
    <p style="color:green;">
        <?= htmlspecialchars($_SESSION['success']); ?>
        <?php unset($_SESSION['success']); ?>
    </p>
<?php endif; ?>

<?php if(!empty($_SESSION['error'])): ?>
    <p style="color:red;">
        <?= htmlspecialchars($_SESSION['error']); ?>
        <?php unset($_SESSION['error']); ?>
    </p>
<?php endif; ?>

<?php if(!empty($requests)): ?>
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>ID Request</th>
            <th>User ID</th>
            <th>Band Name</th>
            <th>Members Emails</th>
            <th>Demo Link</th>
            <th>Data Cererii</th>
            <th>Acțiuni</th>
        </tr>
        <?php foreach($requests as $req): ?>
        <tr>
            <td><?= htmlspecialchars($req->request_id) ?></td>
            <td><?= htmlspecialchars($req->user_id) ?></td>
            <td><?= htmlspecialchars($req->band_name) ?></td>
            <td><?= htmlspecialchars($req->members_emails) ?></td>
            <td><a href="<?= htmlspecialchars($req->demo_link) ?>" target="_blank">Link Demo</a></td>
            <td><?= htmlspecialchars($req->created_at) ?></td>
            <td>
                <a href="<?= ROOT ?>/staff/acceptContract/<?= $req->request_id ?>">Accept</a> | 
                <a href="<?= ROOT ?>/staff/rejectContract/<?= $req->request_id ?>">Reject</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Nu exista cereri in pending.</p>
<?php endif; ?>

<p><a href="<?= ROOT ?>/staff">Inapoi la Staff Dashboard</a></p>

</body>
</html>

