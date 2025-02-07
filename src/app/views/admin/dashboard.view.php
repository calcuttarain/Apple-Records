<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>

<?php require __DIR__ . '/../header.view.php'; ?>

<h1>Bine ai venit, Admin!</h1>

<?php if (!empty($_SESSION['success'])): ?>
    <p style="color:green;">
        <?= htmlspecialchars($_SESSION['success']); ?>
        <?php unset($_SESSION['success']); ?>
    </p>
<?php endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
    <p style="color:red;">
        <?= htmlspecialchars($_SESSION['error']); ?>
        <?php unset($_SESSION['error']); ?>
    </p>
<?php endif; ?>

<p>
    <a href="<?= ROOT ?>/admin/downloadActivityExcel"
       style="padding: 10px; background: #007bff; color: white; text-decoration: none; border-radius: 5px;">
        Descarcă Raport Activitate (Excel)
    </a>
</p>

</body>
</html>
