<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cererile Mele de Album</title>

    <!-- Bootstrap & Stiluri -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../partials/logout_navbar.php'; ?>

<div class="container mt-5 text-center">
    <h1 class="fw-bold">Cererile Mele de Album</h1>

    <?php if (!empty($requests)): ?>
        <div class="table-responsive mt-4">
            <table class="table table-dark table-hover rounded">
                <thead>
                    <tr>
                        <th>ID Cerere</th>
                        <th>Titlu</th>
                        <th>Format</th>
                        <th>Notițe</th>
                        <th>Status</th>
                        <th>Data Creării</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $r): ?>
                    <tr>
                        <td><?= htmlspecialchars($r->id) ?></td>
                        <td><?= htmlspecialchars($r->title) ?></td>
                        <td><?= htmlspecialchars($r->format) ?></td>
                        <td><?= htmlspecialchars($r->notes) ?></td>
                        <td>
                            <span class="badge <?= $r->status === 'Approved' ? 'bg-success' : ($r->status === 'Pending' ? 'bg-warning text-dark' : 'bg-danger') ?>">
                                <?= htmlspecialchars($r->status) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($r->created_at) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="fs-5 text-light opacity-75">Nu ai nicio cerere de album încă.</p>
    <?php endif; ?>

    <a href="<?= ROOT ?>/band_member" class="btn btn-custom-outline mt-4">
        <strong>⟵ Înapoi la Dashboard</strong>
    </a>
</div>

<!-- Bootstrap -->
<script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

