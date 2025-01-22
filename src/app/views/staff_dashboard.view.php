<!DOCTYPE html>
<html>
<head>
    <title>Staff Dashboard</title>
</head>
<body>
<h1>Bine ai venit, Staff!</h1>

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

<ul>
    <li><a href="<?= ROOT ?>/staff/contractRequests">View Contract Pending Requests</a></li>
    <li><a href="<?= ROOT ?>/staff/albumRequests">View Album Pending Requests</a></li>
</ul>

</body>
</html>

