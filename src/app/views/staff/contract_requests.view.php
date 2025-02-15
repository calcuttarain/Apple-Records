<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cereri de Contract | Apple Records</title>
    
    <!-- Bootstrap CSS -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../partials/logout_navbar.php'; ?>

<div class="container mt-5">
    <div class="text-center mx-auto" style="max-width: 850px;">
        <h1 class="display-5 fw-bold">Cereri de Contract (În Așteptare)</h1>

        <!-- ✅ Mesaj de succes -->
        <?php if (!empty($_SESSION['success'])): ?>
            <div class="success-message-1">
                <?= htmlspecialchars($_SESSION['success']); ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- ❌ Mesaj de eroare -->
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="error-message-1">
                <?= htmlspecialchars($_SESSION['error']); ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (!empty($requests)): ?>
            <div class="table-responsive mt-4">
                <table class="table table-dark-custom">
                    <thead class="thead-custom">
                        <tr>
                            <th>ID Cerere</th>
                            <th>User ID</th>
                            <th>Nume Trupă</th>
                            <th>Membri (Email)</th>
                            <th>Demo</th>
                            <th>Data Cererii</th>
                            <th>Acțiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($requests as $req): ?>
                        <tr>
                            <td><?= htmlspecialchars($req->request_id) ?></td>
                            <td><?= htmlspecialchars($req->user_id) ?></td>
                            <td><?= htmlspecialchars($req->band_name) ?></td>
                            <td><?= htmlspecialchars($req->members_emails) ?></td>
                            <td><a href="<?= htmlspecialchars($req->demo_link) ?>" target="_blank" >Ascultă</a></td>
                            <td><?= htmlspecialchars($req->created_at) ?></td>
                            <td class="text-center action-buttons">
                                <a href="<?= ROOT ?>/staff/acceptContract/<?= $req->request_id ?>" class="btn btn-success-custom">Acceptă</a>
                                <a href="<?= ROOT ?>/staff/rejectContract/<?= $req->request_id ?>" class="btn btn-danger-custom">Respinge</a>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="fs-5 text-muted mt-4">Nu există cereri în așteptare.</p>
        <?php endif; ?>

        <div class="mt-4">
            <a href="<?= ROOT ?>/staff" class="btn btn-custom-outline">↩ Înapoi la Staff Dashboard</a>
        </div>
    </div>
</div>

<script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

