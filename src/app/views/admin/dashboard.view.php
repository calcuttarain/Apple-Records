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
        Descarcă Raport Activitate (Excel - CSV)
    </a>
</p>

<p>
    <a href="<?= ROOT ?>/admin/downloadActivityXLSX"
       style="padding: 10px; background: #28a745; color: white; text-decoration: none; border-radius: 5px;">
        Descarcă Raport Activitate (Excel - XLSX)
    </a>
</p>

<p>
    <a href="<?= ROOT ?>/admin/downloadActivityPDF"
       style="padding: 10px; background: #dc3545; color: white; text-decoration: none; border-radius: 5px;">
        Descarcă Raport Activitate (PDF)
    </a>
</p>

<p>
    <a href="<?= ROOT ?>/admin/downloadActivityDOC"
       style="padding: 10px; background: #ffc107; color: black; text-decoration: none; border-radius: 5px;">
        Descarcă Raport Activitate (Word - DOC)
    </a>
</p>

</body>
</html>

