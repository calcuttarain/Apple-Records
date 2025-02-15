<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cererile mele de contract | Apple Records</title>

    <!-- Bootstrap CSS -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../partials/logout_navbar.php'; ?>

<div class="container mt-5">
    <h1 class="text-center text-light mb-4">Cererile mele de contract</h1>

    <?php if (!empty($requests)): ?>
        <div class="table-responsive">
            <table class="table table-dark-custom table-hover text-center">
                <thead class="thead-custom">
                    <tr>
                        <th>ID</th>
                        <th>Data creare</th>
                        <th>Trupă</th>
                        <th>Membri</th>
                        <th>Demo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $r): ?>
                    <tr>
                        <td><?= htmlspecialchars($r->id) ?></td>
                        <td><?= htmlspecialchars($r->created_at) ?></td>
                        <td><?= htmlspecialchars($r->band_name) ?></td>
                        <td><?= htmlspecialchars($r->members_emails) ?></td>
                        <td><a href="<?= htmlspecialchars($r->demo_link) ?>" target="_blank" class="btn btn-custom-outline btn-sm">Ascultă</a></td>
                        <td>
                            <?php if ($r->status === 'Aprobat'): ?>
                                <span class="badge bg-success">Aprobat</span>
                            <?php elseif ($r->status === 'În așteptare'): ?>
                                <span class="badge bg-warning text-dark">În așteptare</span>
                            <?php elseif ($r->status === 'Respins'): ?>
                                <span class="badge bg-danger">Respins</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Necunoscut</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center text-muted fs-5">Momentan nu ai trimis nicio cerere de contract.</p>
        <div class="text-center mt-3">
            <a href="<?= ROOT ?>/band_member/contractForm" class="btn btn-custom-primary">Trimite o cerere acum</a>
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="<?= ROOT ?>/band_member" class="btn btn-custom-outline">Înapoi la Dashboard</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

