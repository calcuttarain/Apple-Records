<!DOCTYPE html>
<html>
<head>
    <title>Band Member Dashboard</title>
</head>
<body>

<?php require __DIR__ . '/../header.view.php'; ?>

<h1>Bine ai venit, Band Member!</h1>

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
    <li><a href="<?= ROOT ?>/band_member/contractForm">Crează cerere de contract</a></li>
    <li><a href="<?= ROOT ?>/band_member/myRequests">Vezi cererile mele de contract</a></li>
</ul>

</body>
</html>

