<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cereri de Albume (În Așteptare)</title>
    
    <!-- Bootstrap CSS -->
    <link href="<?= ROOT ?>/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= ROOT ?>/public/assets/css/styles.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include __DIR__ . '/../partials/logout_navbar.php'; ?>

<div class="container mt-5">
    <h1 class="text-center">Cereri de Albume (În Așteptare)</h1>

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
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>ID Cerere</th>
                        <th>User ID</th>
                        <th>ID Trupă</th>
                        <th>Titlu</th>
                        <th>Format</th>
                        <th>Note</th>
                        <th>Acțiuni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requests as $req): ?>
                        <tr>
                            <td><?= htmlspecialchars($req->request_id) ?></td>
                            <td><?= htmlspecialchars($req->user_id) ?></td>
                            <td><?= htmlspecialchars($req->band_id) ?></td>
                            <td><?= htmlspecialchars($req->title) ?></td>
                            <td><?= htmlspecialchars($req->format) ?></td>
                            <td><?= htmlspecialchars($req->notes) ?></td>
                            <td class="text-center action-buttons">
                                <form action="<?= ROOT ?>/staff/acceptAlbumRequest/<?= $req->request_id ?>" method="POST" class="d-inline-flex gap-2">
                                    <input type="text" name="price" placeholder="Preț" class="input-custom">
                                    <input type="text" name="stock_quantity" placeholder="Stoc" class="input-custom">
                                    <button type="submit" class="btn btn-success-custom">✔ Acceptă</button>
                                </form>

                                <a href="<?= ROOT ?>/staff/rejectAlbumRequest/<?= $req->request_id ?>" 
                                   onclick="return confirm('Sigur respingi cererea #<?= $req->request_id ?>?');"
                                   class="btn btn-danger-custom">
                                    ✖ Respinge
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center text-muted">Nu există cereri de album în pending.</p>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="<?= ROOT ?>/staff" class="btn btn-custom-outline">↩ Înapoi la Staff Dashboard</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="<?= ROOT ?>/public/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>

